<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RankingKonsumen extends CI_Controller {

	public function index()
	{
		$data['title'] = 'Ranking Konsumen';

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('rankingkonsumen');
		$this->load->view('templates/footer');
	}

}

/* End of file RangkingKonsumen.php */
/* Location: ./application/controllers/RankingKonsumen.php */