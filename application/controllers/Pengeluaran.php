<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengeluaran extends CI_Controller {

	public function index()
	{
        $data['title'] = 'Pengeluaran';
		// $this->load->model('Model_Login');
		// $this->Model_Login->keamanan();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('pengeluaran');
		$this->load->view('templates/footer');
	}
}
