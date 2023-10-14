<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index()
	{
		$this->load->model('Model_Login');
		$this->Model_Login->keamanan();
		$this->load->view('welcome_message');
	}
}
