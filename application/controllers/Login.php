<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct()
	{
		parent::__construct();
		$this->load->model('Model_login');
	}

	public function index()
	{
		$this->load->view('login_view');
	}

    public function ceklogin()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $this->load->model('Model_Login');
        $this->Model_Login->ambillogin($username,$password);
    }

    public function logout()
    {
        $this->session->set_userdata('username', FALSE);
        $this->session->sess_destroy();
        redirect('login');
    }
}
