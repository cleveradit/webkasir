<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MasterBonus extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('My_Model');
		$this->load->model('Model_Login');
	}

	public function index()
	{
		$this->Model_Login->keamanan();
		$data['title'] = 'Bonus';
		$data['script'] = base_url('assets/js/master_bonus.js');
		$data['masterbonus'] = $this->My_Model->get_data_simple('bonus')->result_array();
		$data['barang'] = $this->My_Model->get_data_simple('barang')->result_array();
		// echo "<pre>";
		// print_r($data);
		// echo "</pre>";
		// die();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('masterbonus', $data);
		$this->load->view('templates/footer');
	}

	public function load_data(){
		if ($this->My_Model->get_data_simple('bonus')->num_rows() <> null) {
			$no = 1;
			$bonus_array = $this->My_Model->get_data_simple('bonus')->result_array();
			foreach ($bonus_array as $bonus){
				$barang_array = explode(',', $bonus['barang']);
				$table_barang = [];
				foreach ($barang_array as $key => $barang){
					$data_barang = $this->My_Model->get_data_simple('barang', ['barang_id' => $barang])->row();
					$table_barang[] = '<tr><td>'.$data_barang->nama.' '.$data_barang->satuan.' </td></tr>';
				}
				// $table_barang = implode(' ', $table_barang);
				$data['bonus_response'][] = array(
					'no'			=> $no++,
					'bonus_id' => $bonus['bonus_id'],
					'barang' => '<table class="table table-borderless">'.join($table_barang).'</table>',
					'jumlah' => $bonus['jumlah'],
					'hari' => $bonus['hari'],
					'uang' => $bonus['uang'],
					'status' => $bonus['status'],
				);
			}
			header('Content-Type: application/json');
    		echo json_encode(['data' => $data['bonus_response']]);
		}
		else {
			$data['bonus_response'][] = array(
				'no'			=> null,
				'bonus_id' => null,
				'barang' => null,
				'jumlah' => null,
				'hari' => null,
				'uang' => null,
				'status' => null,
			);
		header('Content-Type: application/json');
		echo json_encode(['data' => $data['bonus_response']]);
		}
	}

	public function tambah()
	{
		$data['title'] = 'Tambah Bonus';
		$data['script'] = base_url('assets/js/master_bonus.js');
		$data['barang'] = $this->My_Model->get_data_simple('barang')->result_array();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('tambahbonus');
		$this->load->view('templates/footer');	
	}
	
	public function tambah_aksi()
	{
		$this->_rules();
		if ($this->form_validation->run() == FALSE) { 
			$this->tambah();
		} else {
			$barang = implode(',',$this->input->post('barang'));
			
			$data = array(
				'barang' => $barang,
				'jumlah' => $this->input->post('jumlah'),
				'hari' => $this->input->post('hari'),
				'uang' => $this->input->post('uang'),
				'status' => $this->input->post('status'),
			);
			
			$this->My_Model->save_data('bonus', $data);
			$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert"> Data berhasil ditambahkan! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
			redirect('masterbonus');
		}
	}

	public function edit($id)
	{
		$data['title'] = 'Edit Bonus';
		$data['script'] = base_url('assets/js/master_bonus.js');
		$data['masterbonus'] = $this->My_Model->get_data_simple('bonus', ['bonus_id' => $id])->row();
		$data['barang'] = $this->My_Model->get_data_simple('barang')->result_array();
		// echo "<pre>";
		// print_r($data);
		// echo "</pre>";
		// die();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('editbonus');
		$this->load->view('templates/footer');	
	}

	public function edit_aksi($bonus_id)
	{
		$this->_rules();
		if ($this->form_validation->run() == FALSE) { 
			$this->edit($bonus_id);
		} else {
			$barang = implode(',',$this->input->post('barang'));

			$data = array(
				'barang' => $barang,
				'jumlah' => $this->input->post('jumlah'),
				'hari' => $this->input->post('hari'),
				'uang' => $this->input->post('uang'),
				'status' => $this->input->post('status'),
			);

			$this->My_Model->update_data('bonus', ['bonus_id' => $bonus_id], $data);
			$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert"> Data berhasil diubah! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
			redirect('masterbonus');
		}
	}

	public function delete($id)
	{
		$this->My_Model->delete_data('bonus', ['bonus_id' => $id]);
		$this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert"> Data berhasil dihapus! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		redirect('masterbonus');
	}

	public function _rules()
	{
		$this->form_validation->set_rules('barang[0]', 'Barang', 'required', array(
			'required'=> '%s Harus diisi!'
		));
		$this->form_validation->set_rules('jumlah', 'Jumlah', 'required', array(
			'required'=> '%s Harus diisi!'
		));
		$this->form_validation->set_rules('hari', 'Hari', 'required', array(
			'required'=> '%s Harus diisi!'
		));
		$this->form_validation->set_rules('uang', 'Uang', 'required', array(
			'required'=> '%s Harus diisi!'
		));
		$this->form_validation->set_rules('status', 'Status', 'required', array(
			'required'=> '%s Harus diisi!'
		));
	}
}