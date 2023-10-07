<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RiwayatPenjualan extends CI_Controller {

	public function index()
	{
		$data['title'] = 'Riwayat Penjualan';

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('riwayatpenjualan');
		$this->load->view('templates/footer');
	}

}

/* End of file RiwayatPenjualan.php */
/* Location: ./application/controllers/RiwayatPenjualan.php */