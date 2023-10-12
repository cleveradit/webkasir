<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RiwayatPenjualan extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('My_Model');
	}

	public function print()
	{
		$data['riwayatpenjualan'] = $this->My_Model->get_data_simple('transaksi')->result();
		
		$this->load->view('print_riwayatpenjualan', $data);
	}

	public function index()
	{
		$data['title'] = 'Riwayat Penjualan';

		// $data['masterkonsumen'] = $this->MasterKonsumen_model->get_data('konsumen')->result();

		if ($this->My_Model->get_data_simple('transaksi')->num_rows() > 0) {
			$transaksi = $this->My_Model->get_data_order('transaksi',null,'tanggal desc')->result();
			foreach ($transaksi as $transaksi){
				$konsumen = $this->My_Model->get_data_simple('konsumen', ['id_konsumen' => $transaksi->konsumen_id])->row();
				$barang = explode(',', $transaksi->barang_id);
				$jumlah = explode(',', $transaksi->jumlah);
				$table_barang = [];
				foreach ($barang as $key => $barang){
					$data_barang = $this->My_Model->get_data_simple('barang', ['barang_id' => $barang])->row();
					$table_barang[] = '<tr><td>'.$data_barang->nama.' '.$data_barang->satuan.' '.' ('.$jumlah[$key].')</td></tr>';
				}
				// $table_barang = implode(' ', $table_barang);
				$data['penjualan'][] = array(
					'transaksi_id' => $transaksi->transaksi_id,
					'tanggal' => $transaksi->tanggal,
					'nama_konsumen' => $konsumen->nama_konsumen,
					'total_harga' => $transaksi->total_harga,
					'total_bayar' => $transaksi->total_bayar,
					'barang' => '<table class="table table-borderless">'.join($table_barang).'</table>',
				);
			}
		}
		// echo $data['penjualan'][1]['tanggal'];
		// die();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('riwayatpenjualan', $data);
		$this->load->view('templates/footer');
	}

	public function delete($id)
	{
		$this->My_Model->delete_data('transaksi', ['transaksi_id' => $id]);
			$this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert"> Data berhasil dihapus! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
			redirect('riwayatpenjualan');
	}

}

/* End of file RiwayatPenjualan.php */
/* Location: ./application/controllers/RiwayatPenjualan.php */