<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MasterKonsumen extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('MasterKonsumen_model');
		$this->load->model('My_Model');
	}

	public function index()
	{
		$data['title'] = 'Konsumen';
		$data['script'] = base_url('assets/js/master_konsumen.js');
		$this->load->model('Model_Login');
		$this->Model_Login->keamanan();
		$data['masterkonsumen'] = $this->MasterKonsumen_model->get_data('konsumen')->result();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('masterkonsumen', $data);
		$this->load->view('templates/footer');
	}

	public function load_data(){
		if ($this->MasterKonsumen_model->get_data('konsumen')->num_rows() <> null) {
			$no = 1;
			$masterkonsumen = $this->MasterKonsumen_model->get_data('konsumen')->result_array();
			foreach ($masterkonsumen as $konsumen){
				$konsumen_response[] = [
					'no' => $no++,
					'id_konsumen' => $konsumen['id_konsumen'],
					'nama_konsumen' => $konsumen['nama_konsumen'],
					'nopol' => $konsumen['nopol'],
					'created_at' => $konsumen['created_at'],
				];
			}
			header('Content-Type: application/json');
			echo json_encode(['data' => $konsumen_response]);
		}
		else {
			$konsumen_response[] = [
				'no' => null,
				'id_konsumen' => null,
				'nama_konsumen' => null,
				'nopol' => null,
				'created_at' => null,
			];
			header('Content-Type: application/json');
			echo json_encode(['data' => $konsumen_response]);
		}
	}

	public function excel()
	{
		$data['masterkonsumen'] = $this->MasterKonsumen_model->get_data('konsumen')->result();
		
		require(APPPATH. 'PHPExcel-1.8/Classes/PHPExcel.php');
		require(APPPATH. 'PHPExcel-1.8/Classes/PHPExcel/Writer/Excel2007.php');

		$object = new PHPExcel();

		$object->getProperties()->setTitle("Daftar Konsumen");

		$object->setActiveSheetIndex(0);

		$object->getActiveSheet()->setCellValue('A1', 'NO');
		$object->getActiveSheet()->setCellValue('B1', 'NAMA');
		$object->getActiveSheet()->setCellValue('C1', 'NOPOL');
		$object->getActiveSheet()->setCellValue('D1', 'TANGGAL');

		$baris = 2;
		$no = 1;

		foreach ($data['masterkonsumen'] as $mk)
		{
			$object->getActiveSheet()->setCellValue('A'.$baris, $no++);
			$object->getActiveSheet()->setCellValue('B'.$baris, $mk->nama_konsumen);
			$object->getActiveSheet()->setCellValue('C'.$baris, $mk->nopol);
			$object->getActiveSheet()->setCellValue('D'.$baris, $mk->created_at);

			$baris++;
		}

		$filename="Data_Konsumen".'xlxs';

		$object->getActiveSheet()->setTitle("Data Konsumen");
		
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="'.$filename.'"');
		header('Cache-Control: max-age=0');

		$writer=PHPExcel_IOFactory::createwriter($object, 'Excel2007');
		$writer->save('php://output');

		exit;

	}

	public function tambah()
	{
		$data['title'] = 'Tambah Konsumen';

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
			);

			$this->MasterKonsumen_model->insert_data($data, 'konsumen');
			$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert"> Data berhasil ditambahkan! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
			redirect('masterkonsumen');
		}
	}

	public function edit($id)
	{
		$data['title'] = 'Edit Konsumen';
		$data['masterkonsumen'] = $this->My_Model->get_data_simple('konsumen', ['id_konsumen' => $id])->row();
		// echo "<pre>";
		// print_r($data);
		// echo "</pre>";
		// die();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('editkonsumen');
		$this->load->view('templates/footer');	
	}

	public function edit_aksi($id_konsumen)
	{
		$this->_rules();

		if ($this->form_validation->run() == FALSE) {
			$this->edit($id_konsumen);
		} else {
			$data = array(
				'id_konsumen' => $id_konsumen,
				'nama_konsumen' => $this->input->post('nama_konsumen'),
				'nopol' => $this->input->post('nopol'),
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
		$this->form_validation->set_rules('nopol', 'Nopol', 'required', array(
			'required'=> '%s Harus diisi!'
		));
	}

	public function delete($id)
	{
		$this->MasterKonsumen_model->delete(['id_konsumen' => $id], 'konsumen');
		$this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert"> Data berhasil dihapus! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
		redirect('masterkonsumen');
	}
}

/* End of file MasterKonsumen.php */
/* Location: ./application/controllers/MasterKonsumen.php */