<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set("Asia/Jakarta");

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
		$data['pengeluaran'] = $this->My_Model->get_data_simple('pengeluaran')->result();
		// echo "<pre>";
		// print_r($data['pengeluaran']);
		// echo "</pre>";
		// die();
		
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('pengeluaran', $data);
		$this->load->view('templates/footer');
	}

	public function load_data(){
		if ($this->My_Model->get_data_simple('pengeluaran', null)->num_rows() <> null) {
			
			$no = 1;
			$pengeluaran = $this->My_Model->get_data_order('pengeluaran', null, 'tanggal desc')->result_array();
			// echo "<pre>";
			// print_r($pengeluaran);
			// echo "</pre>";
			// die();
			foreach ($pengeluaran as $pengeluaran){
				$pengeluaran_response []= [
					'no' => $no++,
					'nama_member' => $pengeluaran['nama_member'],
					'nama_barang' => $pengeluaran['nama_barang'],
					'kuantitas' => $pengeluaran['kuantitas'],
					'harga_satuan' => $pengeluaran['harga_satuan'],
					'harga_total' => $pengeluaran['harga_total'],
					'tanggal' => $pengeluaran['tanggal'],
					'id_pengeluaran' => $pengeluaran['id_pengeluaran'],
					'nota_pengeluaran' => $pengeluaran['nota_pengeluaran'],
				];
			}
			// echo "<pre>";
			// print_r($pengeluaran_response[1]['nota_pengeluaran']==null?'null':'not');
			// echo "</pre>";
			// die();
			header('Content-Type: application/json');
			echo json_encode(['data' => $pengeluaran_response]);
		}
		else {
			$pengeluaran_response []= [
				'no' => null,
				'nama_member' => null,
				'nama_barang' => null,
				'kuantitas' => null,
				'harga_satuan' => null,
				'harga_total' => null,
				'tanggal' => null,
				'id_pengeluaran' => null,
				'nota_pengeluaran' => null,
			];
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
			$namabarang = implode(", ",$this->input->post('nama_barang'));
			$kuantitas = implode(", ",$this->input->post('kuantitas'));
			$hargasatuan = implode(", ",$this->input->post('harga_satuan'));
			$barang = $this->input->post('nama_barang');
			$qty = $this->input->post('kuantitas');
			$harga_satuan = $this->input->post('harga_satuan');
			$harga_total = 0;
			foreach($barang as $key => $val_barang){
			$harga_total += $qty[$key] * $harga_satuan[$key];
			}
			$data = array(
				'nama_member' => $this->input->post('nama_member'),
				'nama_barang' => $namabarang,
				'kuantitas' => $kuantitas,
				'harga_satuan' => $hargasatuan,
				'harga_total' => $harga_total,
				'tanggal' => date('Y-m-d h:i:s'),
			);

			$this->My_Model->save_data('pengeluaran', $data);
			$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert"> Data berhasil ditambahkan! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
			redirect('pengeluaran');
		}
	}

	public function edit($id_pengeluaran)
	{
		$this->_rules();

		if ($this->form_validation->run() == FALSE) {
			$this->index();
		} else {
			$data = array(
				'id_pengeluaran' => $id_pengeluaran,
				'nama' => $this->input->post('nama'),
				'nama_barang' => $this->input->post('nama_barang'),
				'kuantitas' => $this->input->post('kuantitas'),
				'harga_satuan' => $this->input->post('harga_satuan'),
			);

			$this->My_Model->update_data('pengeluaran', ['id_pengeluaran' => $id_pengeluaran], $data);
			$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert"> Data berhasil diubah! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
			redirect('pengeluaran');

		}
	}

	public function delete($id)
	{
		$this->My_Model->delete_data('pengeluaran', ['id_pengeluaran' => $id]);
		$this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert"> Data berhasil dihapus! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		redirect('pengeluaran');
	}

	public function upload($id)
	{
		// Pastikan direktori upload tersedia
		$uploadDir = './assets/pengeluaran/';
		if (!is_dir($uploadDir)) {
			mkdir($uploadDir, 0777, true);
		}

		// Mengatur folder berdasarkan tanggal (tahun/bulan/hari)
		$uploadDirDate = $uploadDir . date('Y/m/d/') ;
		if (!is_dir($uploadDirDate)) {
			mkdir($uploadDirDate, 0777, true);
		}

		// Konfigurasi upload
		$config['upload_path'] = $uploadDirDate;
		$config['allowed_types'] = 'gif|jpg|jpeg|png'; // Sesuaikan dengan jenis file yang diizinkan
		$config['max_size'] = 1024; // Sesuaikan dengan ukuran maksimum file (dalam kilobita)

		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('nota_pengeluaran')) {
			$error = array('error' => $this->upload->display_errors());
			print_r($error);
		} else {
			$upload = ($this->upload->data());
			$data = array(
				'nota_pengeluaran' => '/assets/pengeluaran/'.date('Y/m/d/').$upload['file_name'],
			);

			$this->My_Model->update_data('pengeluaran', ['id_pengeluaran' => $id], $data);
			$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert"> Data berhasil diubah! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
			redirect('pengeluaran');
		}
	}


	public function _rules()
	{
		$this->form_validation->set_rules('nama_member', 'Nama', 'required', array(
			'required' => '%s Harus diisi!'
		));

		// Loop through the arrays and set rules for each element
		$nama_barang = $this->input->post('nama_barang');

		foreach ($nama_barang as $key => $val_barang) {
			$this->form_validation->set_rules(
				'nama_barang[' . $key . ']',
				'Nama Barang',
				'required',
				array('required' => '%s Harus diisi!')
			);

			$this->form_validation->set_rules(
				'kuantitas[' . $key . ']',
				'Kuantitas',
				'required',
				array('required' => '%s Harus diisi!')
			);

			$this->form_validation->set_rules(
				'harga_satuan[' . $key . ']',
				'Harga Satuan',
				'required',
				array('required' => '%s Harus diisi!')
			);
		}
	}


}