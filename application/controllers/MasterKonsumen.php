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
		$object->getActiveSheet()->setCellValue('D1', 'SALDO');
		$object->getActiveSheet()->setCellValue('E1', 'TANGGAL');

		$baris = 2;
		$no = 1;

		foreach ($data['masterkonsumen'] as $mk)
		{
			$object->getActiveSheet()->setCellValue('A'.$baris, $no++);
			$object->getActiveSheet()->setCellValue('B'.$baris, $mk->nama_konsumen);
			$object->getActiveSheet()->setCellValue('C'.$baris, $mk->nopol);
			$object->getActiveSheet()->setCellValue('D'.$baris, $mk->saldo);
			$object->getActiveSheet()->setCellValue('E'.$baris, $mk->created_at);

			$baris++;
		}

		$filename="Data_Konsumen".'xlxs';

		$object->getActiveSheet()->setTitle("Data Konsumen");
		
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="'.filename.'"');
		header('Cache-Control: max-age=0');

		$writer=PHPExcel_IOFactory::createwriter($object, 'Excel2007');
		writer->save('php://output');

		exit;

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