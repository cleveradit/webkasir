<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kasir extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		// if ($this->session->userdata('status') !== 'login' ) {
		// 	redirect('/');
		// }
		$this->load->model('My_Model');
	}

	public function index()
	{
		$data['title'] = 'Kasir';
		$data['script'] = base_url('assets/js/kasir.js');

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('kasir');
		$this->load->view('templates/footer');
	}

	public function get_barang()
	{
		header('Content-type: application/json');
		$nama = '';
		$nama = $this->input->post('nama');
        $query = "SELECT barang_id, nama, satuan FROM barang WHERE nama LIKE '%".$nama."%' OR satuan LIKE '%".$nama."%'";
        $search = $this->My_Model->get_query($query)->result();
		foreach ($search as $barang) {
            $data[] = array(
                'id' => $barang->barang_id,
				'text' => $barang->nama.' | '.$barang->satuan
			);
		}
        echo json_encode($data);
	}

    public function get_harga_barang()
	{
		header('Content-type: application/json');
		$id = $this->input->post('id');
        $query = "SELECT harga FROM barang WHERE barang_id = ".$id;
        $data = $this->My_Model->get_query($query)->row();
		echo json_encode($data);
	}

    public function add_keranjang()
	{
		header('Content-type: application/json');
		$id = $this->input->post('id');
        $query = "SELECT * FROM barang WHERE barang_id = ".$id;
        $data = $this->My_Model->get_query($query)->row();
		echo json_encode($data);
	}

}

/* End of file Kasir.php */
/* Location: ./application/controllers/Kasir.php */