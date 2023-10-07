<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MasterKonsumen extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('MasterKonsumen_model');
	}

	public function index()
	{
		$data['title'] = 'Konsumen';
		$data['masterkonsumen'] = $this->MasterKonsumen_model->get_data('konsumen')->result();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('masterkonsumen', $data);
		$this->load->view('templates/footer');
	}

	public function tambah()
	{
		$data['title'] = 'Konsumen';

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('tambahkonsumen');
		$this->load->view('templates/footer');	
	}

	public function tambah_aksi()
	{
		$this->_rules();
		if ($this->form_validation->run() == FALSE) {
			$this->tambah();
		} else {
			$data = array(
				'nama_konsumen' => $this->input->post('nama_konsumen'),
				'nopol' => $this->input->post('nopol'),
				'saldo' => $this->input->post('saldo'),
			);

			$this->MasterKonsumen_model->insert_data($data, 'konsumen');
			$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert"> Data berhasil ditambahkan! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
			redirect('masterkonsumen');
		}
	}

	public function edit($id_konsumen)
	{
		$this->_rules();

		if ($this->form_validation->run() == FALSE) {
			$this->index();
		} else {
			$data = array(
				'id_konsumen' => $id_konsumen,
				'nama_konsumen' => $this->input->post('nama_konsumen'),
				'nopol' => $this->input->post('nopol'),
				'saldo' => $this->input->post('saldo'),
			);

			$this->MasterKonsumen_model->update_data($data, 'konsumen');
			$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert"> Data berhasil diubah! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
			redirect('masterkonsumen');

		}
	}

	public function _rules()
	{
		$this->form_validation->set_rules('nama_konsumen', 'Nama Konsumen', 'required', array(
			'required'=> '%s Harus diisi!'
		));
		$this->form_validation->set_rules('nopol', 'Nama Konsumen', 'required', array(
			'required'=> '%s Harus diisi!'
		));
		$this->form_validation->set_rules('saldo', 'Nama Konsumen', 'required', array(
			'required'=> '%s Harus diisi!'
		));
	}

	public function delete($id)
	{
		$where = array('id_konsumen', $id);

		$this->MasterKonsumen_model->delete($where, 'konsumen');
			$this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert"> Data berhasil dihapus! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
			redirect('masterkonsumen');
	}
}

/* End of file MasterKonsumen.php */
/* Location: ./application/controllers/MasterKonsumen.php */