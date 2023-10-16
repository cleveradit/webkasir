<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RiwayatPenjualan extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('My_Model');
	}

	public function print()
	{
		if ($this->My_Model->get_data_simple('transaksi')->num_rows() > 0) {
			$transaksi = $this->My_Model->get_data_order('transaksi',null,'tanggal desc')->result();
			foreach ($transaksi as $transaksi){
				$konsumen = $this->My_Model->get_data_simple('konsumen', ['id_konsumen' => $transaksi->konsumen_id])->row();
				$barang = explode(',', $transaksi->barang_id);
				$jumlah = explode(',', $transaksi->jumlah);
				$table_barang = [];
				foreach ($barang as $key => $barang){
					$data_barang = $this->My_Model->get_data_simple('barang', ['barang_id' => $barang])->row();
					$table_barang[] = '<tr><td>'.$data_barang->nama.' '.$data_barang->satuan.' '.' ('.$jumlah[$key].')</td></tr>';
				}
				// $table_barang = implode(' ', $table_barang);
				$data['penjualan'][] = array(
					'transaksi_id' => $transaksi->transaksi_id,
					'tanggal' => $transaksi->tanggal,
					'nama_konsumen' => $konsumen->nama_konsumen,
					'total_harga' => $transaksi->total_harga,
					'total_bayar' => $transaksi->total_bayar,
					'barang' => '<table class="table table-borderless">'.join($table_barang).'</table>',
				);
			}
		}
		// $data['riwayatpenjualan'] = $this->My_Model->get_data_simple('transaksi')->result();
		
		$this->load->view('print_riwayatpenjualan', $data);
	}

	public function export_excel()
	{
		if ($this->My_Model->get_data_simple('transaksi')->num_rows() > 0) {
			$transaksi = $this->My_Model->get_data_order('transaksi', null, 'tanggal desc')->result();

			$excel_data = '<table style="border: 1px solid #000; border-collapse: collapse;">';
			$excel_data .= '<tr><th style="border: 1px solid #000;">No.</th><th style="border: 1px solid #000;">Tanggal</th><th style="border: 1px solid #000;">Konsumen</th><th style="border: 1px solid #000;">Nama Barang</th><th style="border: 1px solid #000;">Total Harga</th><th style="border: 1px solid #000;">Total Bayar</th></tr>';

			$no = 1;
			foreach ($transaksi as $transaksi) {
				$konsumen = $this->My_Model->get_data_simple('konsumen', ['id_konsumen' => $transaksi->konsumen_id])->row();
				$barang = explode(',', $transaksi->barang_id);
				$jumlah = explode(',', $transaksi->jumlah);

				$table_barang = '';
				foreach ($barang as $key => $barang) {
					$data_barang = $this->My_Model->get_data_simple('barang', ['barang_id' => $barang])->row();
					$table_barang .= $data_barang->nama . ' ' . $data_barang->satuan . ' (' . $jumlah[$key] . ')<br>';
				}

				$excel_data .= "<tr><td style='border: 1px solid #000;'>$no</td><td style='border: 1px solid #000;'>$transaksi->tanggal</td><td style='border: 1px solid #000;'>$konsumen->nama_konsumen</td><td style='border: 1px solid #000;'>$table_barang</td><td style='border: 1px solid #000;'>$transaksi->total_harga</td><td style='border: 1px solid #000;'>$transaksi->total_bayar</td></tr>";
				$no++;
			}

			$excel_data .= '</table>';

			header("Content-type: application/vnd.ms-excel");
			header("Content-Disposition: attachment; filename=riwayat_penjualan.xls");

			echo $excel_data;
			exit();
		}
	}


	public function index()
	{
		$data['title'] = 'Riwayat Penjualan';

		$this->load->model('Model_Login');
		$this->Model_Login->keamanan();

		if ($this->My_Model->get_data_simple('transaksi')->num_rows() > 0) {
			$transaksi = $this->My_Model->get_data_order('transaksi',null,'tanggal desc')->result();
			foreach ($transaksi as $transaksi){
				$konsumen = $this->My_Model->get_data_simple('konsumen', ['id_konsumen' => $transaksi->konsumen_id])->row();
				$barang = explode(',', $transaksi->barang_id);
				$jumlah = explode(',', $transaksi->jumlah);
				$table_barang = [];
				foreach ($barang as $key => $barang){
					$data_barang = $this->My_Model->get_data_simple('barang', ['barang_id' => $barang])->row();
					$table_barang[] = '<tr><td>'.$data_barang->nama.' '.$data_barang->satuan.' '.' ('.$jumlah[$key].')</td></tr>';
				}
				// $table_barang = implode(' ', $table_barang);
				$data['penjualan'][] = array(
					'transaksi_id' => $transaksi->transaksi_id,
					'tanggal' => $transaksi->tanggal,
					'nama_konsumen' => $konsumen->nama_konsumen,
					'total_harga' => $transaksi->total_harga,
					'total_bayar' => $transaksi->total_bayar,
					'barang' => '<table class="table table-borderless">'.join($table_barang).'</table>',
				);
			}
		}
		// echo $data['penjualan'][1]['tanggal'];
		// die();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('riwayatpenjualan', $data);
		$this->load->view('templates/footer');
	}

	public function delete($id)
	{
		$this->My_Model->delete_data('transaksi', ['transaksi_id' => $id]);
			$this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert"> Data berhasil dihapus! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
			redirect('riwayatpenjualan');
	}

}

/* End of file RiwayatPenjualan.php */
/* Location: ./application/controllers/RiwayatPenjualan.php */