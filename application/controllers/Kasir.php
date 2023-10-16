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

		$this->load->model('Model_Login');
		$this->Model_Login->keamanan();

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

	public function get_konsumen()
	{
		header('Content-type: application/json');
		$nama = '';
		$nama = $this->input->post('nama');
        $query = "SELECT id_konsumen, nama_konsumen, nopol FROM konsumen WHERE nama_konsumen LIKE '%".$nama."%' OR nopol LIKE '%".$nama."%'";
        $search = $this->My_Model->get_query($query)->result();
		foreach ($search as $konsumen) {
            $data[] = array(
                'id' => $konsumen->id_konsumen,
				'text' => $konsumen->nama_konsumen.' | '.$konsumen->nopol
			);
		}
        echo json_encode($data);
	}

	public function checkout()
	{
		$barang = json_decode($this->input->post('barang'));
		$tanggal = new DateTime($this->input->post('tanggal'));
		$kode = array();
		foreach ($barang as $barang) {
			array_push($kode, $barang->id);
		}
		$data = array(
			'tanggal' => $tanggal->format('Y-m-d H:i:s'),
			'barang_id' => implode(',', $kode),
			'jumlah' => implode(',', json_decode($this->input->post('qty'))),
        	'total_harga' => $this->input->post('total_harga'),
        	'total_bayar' => $this->input->post('total_bayar'),
			'konsumen_id' => $this->input->post('konsumen'),
			'nota' => $this->input->post('nota'),
		);
		if ($this->My_Model->save_data('transaksi',$data)) {
			echo json_encode($this->db->insert_id());
		}
		$data = $this->input->post('form');
	}

	public function cetak($id)
	{
		$transaksi = $this->My_Model->get_data_simple('transaksi',['transaksi_id' => $id])->row();
		
		$tanggal = new DateTime($transaksi->tanggal);
		$barcode = explode(',', $transaksi->barang_id);
		$qty = explode(',', $transaksi->jumlah);

		$transaksi->tanggal = $tanggal->format('d/m/Y H:i:s');

		foreach ($barcode as $barang_id){
			$dataBarang[] = $this->My_Model->get_data_simple('barang',['barang_id' => $barang_id])->row();
		}

		foreach ($dataBarang as $key => $value) {
			$value->total = $qty[$key];
			$value->harga = $value->harga * $qty[$key];
		}
		$data = array(
			'nota' => $transaksi->nota,
			'tanggal' => $transaksi->tanggal,
			'barang' => $dataBarang,
			'total' => $transaksi->total_harga,
			'bayar' => $transaksi->total_bayar,
			'kembalian' => $transaksi->total_bayar - $transaksi->total_harga,
		);
		$this->load->view('cetak', $data);
	}

}

/* End of file Kasir.php */
/* Location: ./application/controllers/Kasir.php */