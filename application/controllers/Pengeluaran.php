<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengeluaran extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('My_Model');
	}

	public function index()
	{
        $data['title'] = 'Pengeluaran';
		$data['script'] = base_url('assets/js/pengeluaran.js');
		$this->load->model('Model_Login');
		$this->Model_Login->keamanan();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('pengeluaran', $data);
		$this->load->view('templates/footer');
	}

	public function load_data(){
		if ($this->My_Model->get_data_simple('pengeluaran', null)->num_rows() > 0) {
			$no = 1;
			$pengeluaran = $this->My_Model->get_data_simple('pengeluaran', null)->result_array();
			foreach ($pengeluaran as $pengeluaran){
				$pengeluaran_response []= [
					'no' => $no++,
					'nama_member' => $pengeluaran['nama_member'],
					'nama_barang' => $pengeluaran['nama_barang'],
					'kuantitas' => $pengeluaran['kuantitas'],
					'harga_satuan' => $pengeluaran['harga_satuan'],
					'harga_total' => $pengeluaran['harga_total'],
				];
			}
			// echo "<pre>";
			// print_r($pengeluaran_response);
			// echo "</pre>";
			// die();
			header('Content-Type: application/json');
			echo json_encode(['data' => $pengeluaran_response]);
		}
	}

	public function tambah_aksi()
	{
		$this->_rules();
		if ($this->form_validation->run() == FALSE) {
			$this->index();
		} else {
			$data = array(
				'nama_member' => $this->input->post('nama_member'),
				'nama_barang' => $this->input->post('nama_barang'),
				'kuantitas' => $this->input->post('kuantitas'),
				'harga_satuan' => $this->input->post('harga_satuan'),
				'harga_total' => $this->input->post('harga_total'),
			);

			$this->My_Model->save_data('pengeluaran', $data);
			$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert"> Data berhasil ditambahkan! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
			redirect('pengeluaran');
		}
	}

public function _rules()
	{
		$this->form_validation->set_rules('nama_member', 'Nama', 'required', array(
			'required'=> '%s Harus diisi!'
		));
		$this->form_validation->set_rules('nama_barang', 'Nama Barang', 'required', array(
			'required'=> '%s Harus diisi!'
		));
		$this->form_validation->set_rules('kuantitas', 'Kuantitas', 'required', array(
			'required'=> '%s Harus diisi!'
		));
		$this->form_validation->set_rules('harga_satuan', 'Harga Satuan', 'required', array(
			'required'=> '%s Harus diisi!'
		));
		$this->form_validation->set_rules('harga_total', 'Harga Total', 'required', array(
			'required'=> '%s Harus diisi!'
		));
	}

}