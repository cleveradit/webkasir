<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_Login extends CI_Model {

    public function ambillogin($username, $password)
    {
        $this->db->where('username', $username);
        $this->db->where('password', $password); // Note: Always hash and compare passwords!
        $query = $this->db->get('login');
        if ($query->num_rows() > 0)
        {
            foreach ($query->result() as $row)
            {
                $sess = array('username' => $row->username,
                              'password' => $row->password); // Don't store passwords in session
            }
            $this->session->set_userdata($sess);
            redirect('kasir');
        }
        else {
            $this->session->set_flashdata('info', 'Maaf Username dan Password Anda Salah!');
            redirect('login');
        }
    }
    
    public function logout()
    {
        $this->session->unset_userdata('username');
        $this->session->sess_destroy();
        redirect('login');
    }

    public function keamanan()
    {
        $username = $this->session->userdata('username');
        
        if (empty($username)) {
            $this->session->set_flashdata('info', 'You need to login first!');
            redirect('login');
        }
    }
}
