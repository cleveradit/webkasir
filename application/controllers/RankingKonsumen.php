<?php
defined('BASEPATH') or exit('No direct script access allowed');

class RankingKonsumen extends CI_Controller
{

	public function index()
	{
		$data['title'] = 'Ranking Konsumen';
		$data['script'] = base_url('assets/js/ranking_konsumen.js');

		$this->load->model('Model_Login');
		$this->Model_Login->keamanan();



		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('rankingkonsumen', $data);
		$this->load->view('templates/footer');
	}

	public function load_data()
	{
		$this->load->model('My_Model');
		$date = date("Y-m");
		if ($this->My_Model->get_data_simple('transaksi', ['tanggal like' => $date.'%'])->num_rows() <> null) {
			$konsumen = $this->My_Model->get_query("SELECT konsumen_id, SUM(total_harga) as transaksi_total FROM transaksi WHERE tanggal LIKE '" . $date . "%' GROUP BY konsumen_id ORDER BY SUM(total_harga) desc LIMIT 5")->result();
			$no = 1;
			foreach ($konsumen as $konsumen){
				$transaksi = $this->My_Model->get_data_simple('transaksi', ['tanggal like' => $date.'%', 'konsumen_id' => $konsumen->konsumen_id])->result_array();
				$transaksi_jumlah = 0;
				foreach ($transaksi as $t){
					$qty = explode(',', $t['jumlah']);
					foreach ($qty as $q){
						$transaksi_jumlah += $q;
					}
				}
				$transaksi_total_harga = $this->My_Model->get_query("SELECT konsumen_id, SUM(total_harga) as transaksi_total_harga FROM transaksi WHERE (konsumen_id = ".$konsumen->konsumen_id." AND tanggal LIKE '".$date."%') GROUP BY konsumen_id")->row();
				$nama_konsumen = $this->My_Model->get_query("SELECT nama_konsumen FROM konsumen WHERE id_konsumen =".$konsumen->konsumen_id."")->row();
				// die();
				
					$data['transaksi'][] = array(
						'no'			=> $no++,
						'nama_konsumen' => $nama_konsumen->nama_konsumen,
						'transaksi_total_harga' => $transaksi_total_harga->transaksi_total_harga,
						'transaksi_jumlah' => $transaksi_jumlah,
					);
				
			}
			// echo "<pre>";
			// print_r($data);
			// echo "</pre>";
			// die();
		}else{
			$data['transaksi'][] = array(
				'no'			  => null,
				'nama_konsumen'   => null,
				'transaksi_total_harga' => null,
				'transaksi_jumlah' => null,
			);
		}
		header('Content-Type: application/json');
		echo json_encode(['data' => $data['transaksi']]);
	}
}

/* End of file RangkingKonsumen.php */
/* Location: ./application/controllers/RankingKonsumen.php */