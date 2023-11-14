<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RankingKonsumen extends CI_Controller {

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

	public function load_data(){
		$this->load->model('My_Model');
		if ($this->My_Model->get_data_simple('transaksi')->num_rows() > 0) {
			$date = date("Y-m");
			$konsumen = $this->My_Model->get_query("SELECT konsumen_id, SUM(total_harga) as transaksi_total FROM transaksi WHERE tanggal LIKE '".$date."%' GROUP BY konsumen_id ORDER BY SUM(total_harga) desc LIMIT 5")->result();
			$no = 1;
		// 	echo "<pre>";
		// print_r($konsumen);
		// echo "</pre>";
		// die();
			foreach ($konsumen as $konsumen){
				$transaksi_total = $this->My_Model->get_query("SELECT konsumen_id, SUM(total_harga) as transaksi_total, COUNT(*) as total_transaksi FROM transaksi WHERE (konsumen_id = ".$konsumen->konsumen_id." AND tanggal LIKE '".$date."%') GROUP BY konsumen_id")->row();
				$nama_konsumen = $this->My_Model->get_query("SELECT nama_konsumen FROM konsumen WHERE id_konsumen =".$konsumen->konsumen_id."")->row();
				if ($transaksi_total != null) {
				$data['transaksi'][] = array(
					'no'			=> $no++,
					'nama_konsumen' => $nama_konsumen->nama_konsumen,
					'transaksi_total' => $transaksi_total->transaksi_total,
					'total_transaksi' => $transaksi_total->total_transaksi,
				);
				}
			}
		// 	echo "<pre>";
		// print_r($data['transaksi']);
		// echo "</pre>";
		// die();
			header('Content-Type: application/json');
    		echo json_encode(['data' => $data['transaksi']]);
		}
	}

}

/* End of file RangkingKonsumen.php */
/* Location: ./application/controllers/RankingKonsumen.php */