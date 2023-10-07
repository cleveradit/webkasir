<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kasir extends CI_Controller {

	public function index()
	{
		$data['title'] = 'Kasir';

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('kasir');
		$this->load->view('templates/footer');
	}

}

/* End of file Kasir.php */
/* Location: ./application/controllers/Kasir.php */