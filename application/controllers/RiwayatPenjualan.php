<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class RiwayatPenjualan extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('My_Model');
	}

	public function print()
	{
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
		// $data['riwayatpenjualan'] = $this->My_Model->get_data_simple('transaksi')->result();
		
		$this->load->view('print_riwayatpenjualan', $data);
	}

	public function export_excel()
	{
		if ($this->My_Model->get_data_simple('transaksi')->num_rows() > 0) {
			$transaksi = $this->My_Model->get_data_order('transaksi', null, 'tanggal desc')->result();

			$excel_data = '<table style="border: 1px solid #000; border-collapse: collapse;">';
			$excel_data .= '<tr><th style="border: 1px solid #000;">No.</th><th style="border: 1px solid #000;">Tanggal</th><th style="border: 1px solid #000;">Konsumen</th><th style="border: 1px solid #000;">Nama Barang</th><th style="border: 1px solid #000;">Total Harga</th><th style="border: 1px solid #000;">Total Bayar</th></tr>';

			$no = 1;
			foreach ($transaksi as $transaksi) {
				$konsumen = $this->My_Model->get_data_simple('konsumen', ['id_konsumen' => $transaksi->konsumen_id])->row();
				$barang = explode(',', $transaksi->barang_id);
				$jumlah = explode(',', $transaksi->jumlah);

				$table_barang = '';
				foreach ($barang as $key => $barang) {
					$data_barang = $this->My_Model->get_data_simple('barang', ['barang_id' => $barang])->row();
					$table_barang .= $data_barang->nama . ' ' . $data_barang->satuan . ' (' . $jumlah[$key] . ')<br>';
				}

				$excel_data .= "<tr><td style='border: 1px solid #000;'>$no</td><td style='border: 1px solid #000;'>$transaksi->tanggal</td><td style='border: 1px solid #000;'>$konsumen->nama_konsumen</td><td style='border: 1px solid #000;'>$table_barang</td><td style='border: 1px solid #000;'>$transaksi->total_harga</td><td style='border: 1px solid #000;'>$transaksi->total_bayar</td></tr>";
				$no++;
			}

			$excel_data .= '</table>';

			header("Content-type: application/vnd.ms-excel");
			header("Content-Disposition: attachment; filename=riwayat_penjualan.xls");

			echo $excel_data;
			exit();
		}
	}


	public function index()
	{
		$data['title'] = 'Riwayat Penjualan';
		$data['script'] = base_url('assets/js/riwayat_penjualan.js');

		$this->load->model('Model_Login');
		$this->Model_Login->keamanan();

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

	public function load_data(){
		if ($this->My_Model->get_data_simple('transaksi')->num_rows() > 0) {
			$transaksi = $this->My_Model->get_data_order('transaksi',null,'tanggal desc')->result();
			$no = 1;
			foreach ($transaksi as $transaksi){
				$konsumen = $this->My_Model->get_data_simple('konsumen', ['id_konsumen' => $transaksi->konsumen_id])->row();
				$barang = explode(',', $transaksi->barang_id);
				$jumlah = explode(',', $transaksi->jumlah);
				$table_barang = [];
				foreach ($barang as $key => $barang){
					$data_barang = $this->My_Model->get_data_simple('barang', ['barang_id' => $barang])->row();
					$table_barang[] = '<tr><td>'.$data_barang->nama.' '.$data_barang->satuan.' '.' ('.$jumlah[$key].') </td></tr>';
				}
				// $table_barang = implode(' ', $table_barang);
				$data['penjualan'][] = array(
					'no'			=> $no++,
					'transaksi_id' => $transaksi->transaksi_id,
					'tanggal' => $transaksi->tanggal,
					'nama_konsumen' => $konsumen->nama_konsumen,
					'total_harga' => $transaksi->total_harga,
					'total_bayar' => $transaksi->total_bayar,
					'barang' => '<table class="table table-borderless">'.join($table_barang).'</table>',
				);
			}
			header('Content-Type: application/json');
    		echo json_encode(['data' => $data['penjualan']]);
		}
	}

	public function download_excel(){
		// Load the existing Excel file
		$inputFileName = 'D:/Download/riwayat.xlsx';
		$spreadsheet = IOFactory::load($inputFileName);
	
		// Fetch data
		$date = date('Y-m-d');
		$transaksi = $this->My_Model->get_data_order('transaksi', ['tanggal like' => $date.'%'], 'tanggal desc')->result();
		$no = 1;
		$total_pendapatan = 0;
		$data = [];
	
		foreach ($transaksi as $transaksi) {
			$konsumen = $this->My_Model->get_data_simple('konsumen', ['id_konsumen' => $transaksi->konsumen_id])->row();
			$barang = explode(',', $transaksi->barang_id);
			$jumlah = explode(',', $transaksi->jumlah);
			$table_barang = [];
			$total_pendapatan += $transaksi->total_harga;
	
			foreach ($barang as $key => $barang) {
				$data_barang = $this->My_Model->get_data_simple('barang', ['barang_id' => $barang])->row();
				$table_barang[] = $data_barang->nama . ' ' . $data_barang->satuan . ' (' . $jumlah[$key] . ')';
			}
	
			$data[] = [
				'no' => $no++,
				'tanggal' => $transaksi->tanggal,
				'konsumen' => $konsumen->nama_konsumen,
				'harga' => $transaksi->total_harga,
				'barang' => implode("\n", $table_barang), // Menggunakan "\n" sebagai pemisah untuk data barang
			];
		}

		// Get the sheet you want to edit (e.g., sheet index 0)
		$sheet = $spreadsheet->getSheet(0);

		// Find the highest row number with data in the first column (A)
		$highestRow = $sheet->getHighestRow();

		$worksheet0 = $sheet;

		// Update cell values in the existing sheet
		$worksheet0->setCellValue('A' . $highestRow+2, 'PENDAPATAN '.$date);
		$worksheet0->setCellValue('B' . $highestRow+2, $total_pendapatan);
	
		// Create a new worksheet
		$newSheet = new \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet($spreadsheet, $date);
		$spreadsheet->addSheet($newSheet);
	
		// Set data for the new sheet
		$worksheet = $newSheet;

		$worksheet->setCellValue('A' . 1, 'PENDAPATAN');
		$worksheet->setCellValue('A' . 2, $total_pendapatan);
		$worksheet->setCellValue('C' . 1, 'NO');
		$worksheet->setCellValue('D' . 1, 'TANGGAL');
		$worksheet->setCellValue('E' . 1, 'KONSUMEN');
		$worksheet->setCellValue('F' . 1, 'HARGA');
		$worksheet->setCellValue('G' . 1, 'BARANG');

		$row = 2;
	
		foreach ($data as $row_data) {
			$col = 'C';
	
			foreach ($row_data as $key => $cell_data) {
				// tambahkan head menggunakan key
				$worksheet->setCellValue($col . $row, $cell_data);
				$col++;
			}
	
			$row++;
		}
	
		// Save the modified Excel file
		$outputFileName = 'D:/Download/riwayat.xlsx';
		$writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
		$writer->save($outputFileName);
	
		// Set header for download
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="' . basename($outputFileName) . '"');
		header('Cache-Control: max-age=0');
		readfile($outputFileName);
	}
	

}

/* End of file RiwayatPenjualan.php */
/* Location: ./application/controllers/RiwayatPenjualan.php */