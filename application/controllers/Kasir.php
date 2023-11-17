<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kasir extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		// if ($this->session->userdata('status') !== 'login' ) {
		// 	redirect('/');
		// }
		$this->load->model('My_Model');
	}

	public function index()
	{
		$data['title'] = 'Kasir';
		$data['script'] = base_url('assets/js/kasir.js');

		$this->load->model('Model_Login');
		$this->Model_Login->keamanan();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('kasir');
		$this->load->view('templates/footer');
	}

	public function get_barang()
	{
		header('Content-type: application/json');
		$nama = '';
		$nama = $this->input->post('nama');
		$query = "SELECT barang_id, nama, satuan FROM barang WHERE nama LIKE '%" . $nama . "%' OR satuan LIKE '%" . $nama . "%'";
		$search = $this->My_Model->get_query($query)->result();
		foreach ($search as $barang) {
			$data[] = array(
				'id' => $barang->barang_id,
				'text' => $barang->nama . ' | ' . $barang->satuan
			);
		}
		echo json_encode($data);
	}

	public function get_harga_barang()
	{
		header('Content-type: application/json');
		$id = $this->input->post('id');
		$query = "SELECT harga FROM barang WHERE barang_id = " . $id;
		$data = $this->My_Model->get_query($query)->row();
		echo json_encode($data);
	}

	public function add_keranjang()
	{
		header('Content-type: application/json');
		$id = $this->input->post('id');
		$query = "SELECT * FROM barang WHERE barang_id = " . $id;
		$data = $this->My_Model->get_query($query)->row();
		echo json_encode($data);
	}

	public function get_konsumen()
	{
		header('Content-type: application/json');
		$nama = '';
		$nama = $this->input->post('nama');
		$query = "SELECT id_konsumen, nama_konsumen, nopol FROM konsumen WHERE nama_konsumen LIKE '%" . $nama . "%' OR nopol LIKE '%" . $nama . "%'";
		$search = $this->My_Model->get_query($query)->result();
		foreach ($search as $konsumen) {
			$data[] = array(
				'id' => $konsumen->id_konsumen,
				'text' => $konsumen->nama_konsumen . ' | ' . $konsumen->nopol
			);
		}
		echo json_encode($data);
	}

	public function get_bonus($konsumen_id = null)
	{
		$param = $konsumen_id;
		if ($this->input->post('konsumen')) {
			$konsumen_id = $this->input->post('konsumen');
		}
		// $konsumen_id = 4;
		$konsumen = $this->My_Model->get_data_simple('konsumen', ['id_konsumen' => $konsumen_id])->row_array();

		$query = 'SELECT * FROM transaksi WHERE konsumen_id = ' . $konsumen_id . ' AND status_bonus LIKE "%0%"';

		$bonus = $this->My_Model->get_data_simple('bonus', ['status' => 'aktif'])->result_array();

		// Cek tiap bonus
		foreach ($bonus as $b) {
			$query .= ' AND tanggal >= DATE_SUB(NOW(), INTERVAL ' . $b['hari'] . ' DAY) AND (';
			$barang_bonus = explode(',', $b['barang']);
			foreach ($barang_bonus as $key => $value) {
				if (count($barang_bonus) > 1) {
					if ($key == 0) {
						$query .= 'barang_id LIKE "%' . $value . '%"';
					} else {
						$query .= 'OR barang_id LIKE "%' . $value . '%")';
					}
				} else {
					$query .= 'barang_id LIKE "%' . $value . '%")';
				}
			}
			$transaksi = $this->My_Model->get_query($query)->result_array();
			$total = 0;
			$total_keranjang = 0;
			// Total pembelian berdasarkan barang yang sesuai
			foreach ($transaksi as $t) {
				$barang_id = explode(',', $t['barang_id']);
				$jumlah = explode(',', $t['jumlah']);
				$status_bonus = explode(',', $t['status_bonus']);
				foreach ($barang_id as $key => $barang) {
					foreach ($barang_bonus as $bb) {
						if (count($status_bonus) > 1) {
							if ($barang == $bb && $status_bonus[$key] != 1) {
								$total += $jumlah[$key];
							}
						} else {
							if ($barang == $bb) {
								$total += $jumlah[$key];
							}
						}
					}
				}
			}
			if ($this->input->post('id_barang')) {
				// Total pembelian dengan keranjang berdasarkan barang yang sesuai
				$barang_keranjang = json_decode($this->input->post('id_barang'));
				$jumlah_keranjang = json_decode($this->input->post('qty'));
				// $barang_keranjang = ["3"];
				// $jumlah_keranjang = ["2"];
				foreach ($barang_keranjang as $key => $bka) {
					foreach ($barang_bonus as $bb2) {
						if ($bka == $bb2) {
							$total += $jumlah_keranjang[$key];
							$total_keranjang += $jumlah_keranjang[$key];
						}
					}
				}
			}
			// Cek apakah konsumen sudah mengambil apa belum
			foreach ($transaksi as $transaksi){
				$bonus = explode(',', $transaksi['bonus']);
				foreach ($bonus as $bonus){
					$bonus_jumlah = $bonus!=0 ? $this->My_Model->get_data_simple('bonus', ['bonus_id' => $bonus])->row()->jumlah : 0;
					if ($bonus_jumlah < $b['jumlah'] && $bonus_jumlah != 0){
						// Cek apakah total memenuhi syarat pembelian bonus
						if ($total >= $b['jumlah']) {
							$bonus_barang_array = explode(',', $b['barang']);
							$barang_text = array();
							foreach ($bonus_barang_array as $bba) {
								$barang_row = $this->My_Model->get_data_simple('barang', ['barang_id' => $bba])->row();
								array_push($barang_text, $barang_row->nama . '(' . $barang_row->satuan . ')');
							}
							$barang_response = implode(',', $barang_text);
							$response = [
								'status' => 'Berhak mendapat reward',
								'bonus_id' => $b['bonus_id'],
								'syarat_pembelian' => $b['jumlah'],
								'total_pembelian' => $total,
								'barang' => $barang_response,
								'hari' => $b['hari'],
								'uang' => $b['uang']
							];
						}
					}
				}
			}
			if ($total_keranjang >= $b['jumlah']) {
				$bonus_barang_array = explode(',', $b['barang']);
				$barang_text = array();
				foreach ($bonus_barang_array as $bba) {
					$barang_row = $this->My_Model->get_data_simple('barang', ['barang_id' => $bba])->row();
					array_push($barang_text, $barang_row->nama . '(' . $barang_row->satuan . ')');
				}
				$barang_response = implode(',', $barang_text);
				$response = [
					'status' => 'Berhak mendapat reward',
					'bonus_id' => $b['bonus_id'],
					'syarat_pembelian' => $b['jumlah'],
					'total_pembelian' => $total,
					'barang' => $barang_response,
					'hari' => $b['hari'],
					'uang' => $b['uang']
				];
			}
		}
		if (!isset($response)) {
			$bonus_terdekat = $this->My_Model->get_data_order('bonus', ['jumlah >' => $total], 'jumlah ASC')->row();
			$get_bonus_barang_terdekat = explode(',', $bonus_terdekat->barang);
			$nama_satuan_bonus_terdekat = array();
			foreach ($get_bonus_barang_terdekat as $gbbt) {
				$barang_bonus = $this->My_Model->get_data_simple('barang', ['barang_id' => $gbbt])->row();
				array_push($nama_satuan_bonus_terdekat, $barang_bonus->nama . '(' . $barang_bonus->satuan . ')');
			}
			$barang_response_terdekat = implode(',', $nama_satuan_bonus_terdekat);
			$response = [
				'status' => 'Belum berhak mendapat reward',
				'bonus_id' => $bonus_terdekat->bonus_id,
				'syarat_pembelian' => $bonus_terdekat->jumlah,
				'total_pembelian' => $total,
				'barang' => $barang_response_terdekat,
				'hari' => $bonus_terdekat->hari,
				'uang' => $bonus_terdekat->uang
			];
		}
		if ($param) {
			return $response;
		} else {
			echo json_encode($response);
		}
	}

	public function checkout()
	{
		// $barang = json_decode($this->input->post('barang'));
		$tanggal = new DateTime($this->input->post('tanggal'));
		// $kode = array();
		// foreach ($barang as $barang) {
		// 	array_push($kode, $barang);
		// }
		// echo "<pre>";
		// print_r($this->input->post('bonus_id'));
		// echo "</pre>";
		// die();
		$data = array(
			'tanggal' => $tanggal->format('Y-m-d H:i:s'),
			'barang_id' => implode(',', json_decode($this->input->post('barang'))),
			'jumlah' => implode(',', json_decode($this->input->post('qty'))),
			'total_harga' => $this->input->post('total_harga'),
			'total_bayar' => $this->input->post('total_bayar'),
			'konsumen_id' => $this->input->post('konsumen'),
			'nota' => $this->input->post('nota'),
			'bonus' => implode(',', json_decode($this->input->post('status_bonus'))),
			'status_bonus' => implode(',', json_decode($this->input->post('status_bonus'))),
		);
		if ($this->My_Model->save_data('transaksi', $data)) {
			$data['id'] = $this->db->insert_id();
			$data['status'] = $this->input->post('status');
			$data['bonus_id'] = $this->input->post('bonus_id');

			$bonus = $this->My_Model->get_data_simple('bonus', ['bonus_id' => $this->input->post('bonus_id')])->row();
			if($bonus){
				$data['bonus_text'] = 'Rp.'.$bonus->uang;
			}
			echo json_encode($data);
		}
		$data = $this->input->post('form');
	}

	public function cetak($id)
	{
		$transaksi = $this->My_Model->get_data_simple('transaksi', ['transaksi_id' => $id])->row();
		$bonus = $this->get_bonus($transaksi->konsumen_id);

		$tanggal = new DateTime($transaksi->tanggal);
		$barcode = explode(',', $transaksi->barang_id);
		$qty = explode(',', $transaksi->jumlah);

		$transaksi->tanggal = $tanggal->format('d/m/Y H:i:s');

		foreach ($barcode as $barang_id) {
			$dataBarang[] = $this->My_Model->get_data_simple('barang', ['barang_id' => $barang_id])->row();
		}

		foreach ($dataBarang as $key => $value) {
			$value->total = $qty[$key];
			$value->harga = $value->harga * $qty[$key];
		}
		$data = array(
			'bonus' => $bonus['total_pembelian'] . '/' . $bonus['syarat_pembelian'] . ' Rp. ' . $bonus['uang'],
			'nota' => $transaksi->nota,
			'tanggal' => $transaksi->tanggal,
			'barang' => $dataBarang,
			'total' => $transaksi->total_harga,
			'bayar' => $transaksi->total_bayar,
			'kembalian' => $transaksi->total_bayar - $transaksi->total_harga,
		);
		$this->load->view('cetak', $data);
	}

	public function reset_bonus($konsumen_id, $bonus_id)
	{
		// Get bonus
		// Get barang bonus
		// Get transaksi where konsumen_id & like barang bonus
		// Update transaksi yang barang bonusnya sama 'reward telah diambil'
		$bonus = $this->My_Model->get_data_simple('bonus', ['bonus_id' => $bonus_id])->row_array();

		$query = 'SELECT * FROM transaksi WHERE konsumen_id = ' . $konsumen_id;

		$query .= ' AND tanggal >= DATE_SUB(NOW(), INTERVAL ' . $bonus['hari'] . ' DAY) AND (';
		$barang_bonus = explode(',', $bonus['barang']);
		foreach ($barang_bonus as $key => $value) {
			if (count($barang_bonus) > 1) {
				if ($key == 0) {
					$query .= 'barang_id LIKE "%' . $value . '%"';
				} else {
					$query .= 'OR barang_id LIKE "%' . $value . '%")';
				}
			} else {
				$query .= 'barang_id LIKE "%' . $value . '%")';
			}
		}
		$transaksi = $this->My_Model->get_query($query)->result_array();

		foreach ($transaksi as $transaksi) {
			$transaksi_barang = explode(',', $transaksi['barang_id']);
			$sama = [];
			foreach ($transaksi_barang as $key => $transaksi_barangs) {
				$sama[$key] = 0;
				foreach ($barang_bonus as $bb) {
					if ($transaksi_barangs == $bb) {
						$sama[$key] = 1;
					}
				}
				$transaksi_bonus = explode(',', $transaksi['bonus']);
				$sama_bonus = [];
				foreach ($transaksi_bonus as $keys => $transaksi_bonuss) {
					$sama_bonus[$keys] = $transaksi_bonuss;
					foreach ($barang_bonus as $bb) {
						if ($transaksi_barangs == $bb) {
							$sama_bonus[$keys] = 0;
						}
					}
				}
			}
			$status_bonus = implode(',', $sama);

			$bonus = implode(',', $sama_bonus);
			// echo "<pre>";
			// print_r($bonus);
			// echo "</pre>";
			// die();
			$this->My_Model->update_data('transaksi', ['transaksi_id' => $transaksi['transaksi_id']], ['status_bonus' => $status_bonus, 'bonus' => $bonus]);
		}
	}

	public function keep_bonus($konsumen_id, $bonus_id)
	{
		// Get bonus
		// Get barang bonus
		// Get transaksi where konsumen_id & like barang bonus
		// Update transaksi yang barang bonusnya sama 'reward telah diambil'
		$bonus = $this->My_Model->get_data_simple('bonus', ['bonus_id' => $bonus_id])->row_array();

		$query = 'SELECT * FROM transaksi WHERE konsumen_id = ' . $konsumen_id;

		$query .= ' AND tanggal >= DATE_SUB(NOW(), INTERVAL ' . $bonus['hari'] . ' DAY) AND (';
		$barang_bonus = explode(',', $bonus['barang']);
		foreach ($barang_bonus as $key => $value) {
			if (count($barang_bonus) > 1) {
				if ($key == 0) {
					$query .= 'barang_id LIKE "%' . $value . '%"';
				} else {
					$query .= 'OR barang_id LIKE "%' . $value . '%")';
				}
			} else {
				$query .= 'barang_id LIKE "%' . $value . '%")';
			}
		}
		$transaksi = $this->My_Model->get_query($query)->result_array();

		foreach ($transaksi as $transaksi) {
			$transaksi_barang = explode(',', $transaksi['barang_id']);
			$sama = [];
			foreach ($transaksi_barang as $key => $transaksi_barangs) {
				$sama[$key] = 0;
				foreach ($barang_bonus as $bb) {
					if ($transaksi_barangs == $bb) {
						$sama[$key] = $bonus_id;
					}
				}
			}
			$bonus = implode(',', $sama);
			$this->My_Model->update_data('transaksi', ['transaksi_id' => $transaksi['transaksi_id']], ['bonus' => $bonus]);
		}
	}
}

/* End of file Kasir.php */
/* Location: ./application/controllers/Kasir.php */