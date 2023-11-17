<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MasterBarang extends CI_Controller {

    public function __construct()
	{
		parent::__construct();
		$this->load->model('My_Model');
		$this->load->model('Model_Login');
	}

	public function index()
	{
		$this->Model_Login->keamanan();
		$data['title'] = 'Barang';
        $data['script'] = base_url('assets/js/master_barang.js');
		$data['masterbarang'] = $this->My_Model->get_data_simple('barang', null)->result();
		// echo "<pre>";
		// print_r($data);
		// echo "</pre>";
		// die();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('masterbarang', $data);
		$this->load->view('templates/footer');
	}
	public function load_data(){
		if ($this->My_Model->get_data_simple('barang', null)->num_rows() <> null) {
			$no = 1;
			$masterbarang = $this->My_Model->get_data_simple('barang', null)->result_array();
            
			foreach ($masterbarang as $barang){
				$barang_response[] = [
					'no' => $no++,
					'nama' => $barang['nama'],
					'kode' => $barang['kode'],
					'satuan' => $barang['satuan'],
					'harga' => $barang['harga'],
                    'barang_id' => $barang['barang_id'],
				];
			}
        //     echo "<pre>";
		// print_r($barang_response);
		// echo "</pre>";
		// die();
			header('Content-Type: application/json');
			echo json_encode(['data' => $barang_response]);
		}
		else {
			$barang_response[] = [
                'no' => null,
                'nama' => null,
                'kode' => null,
                'satuan' => null,
                'harga' => null,
            ];
			header('Content-Type: application/json');
			echo json_encode(['data' => $barang_response]);
		}
	}

	public function tambah_aksi()
	{
		$this->_rules();
		if ($this->form_validation->run() == FALSE) { 
			$this->index();
		} else {
			$data = array(
				'nama' => $this->input->post('nama'),
				'kode' => $this->input->post('kode'),
				'satuan' => $this->input->post('satuan'),
				'harga' => $this->input->post('harga'),
			);

			$this->My_Model->save_data('barang', $data);
			$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert"> Data berhasil ditambahkan! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
			redirect('masterbarang');
		}
	}

    public function _rules()
	{
		$this->form_validation->set_rules('nama', 'Nama', 'required', array(
			'required'=> '%s Harus diisi!'
		));
		$this->form_validation->set_rules('kode', 'Kode', 'required', array(
			'required'=> '%s Harus diisi!'
		));
		$this->form_validation->set_rules('satuan', 'Satuan', 'required', array(
			'required'=> '%s Harus diisi!'
		));
		$this->form_validation->set_rules('harga', 'Harga', 'required', array(
			'required'=> '%s Harus diisi!'
		));
	}

    public function delete($id)
	{
		$this->My_Model->delete_data('barang', ['barang_id' => $id]);
		$this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert"> Data berhasil dihapus! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		redirect('masterbarang');
	}

	public function edit($id)
	{
		$this->_rules();

		if ($this->form_validation->run() == FALSE) {
			$this->index();
		} else {
			$data = array(
				'nama' => $this->input->post('nama'),
				'kode' => $this->input->post('kode'),
				'satuan' => $this->input->post('satuan'),
				'harga' => $this->input->post('harga'),
			);

			$this->My_Model->update_data('barang', ['barang_id' => $id], $data);
			$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert"> Data berhasil diubah! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
			redirect('masterbarang');

		}
	}

}