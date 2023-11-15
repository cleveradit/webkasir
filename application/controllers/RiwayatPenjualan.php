<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

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
	
	public function download_excel_new(){
		// $transaksi_tanggal_list = $this->My_Model->get_data_order_group('transaksi', ['tanggal like' => '%'.date("Y-m").'%'], 'tanggal asc', "DATE_FORMAT(tanggal, '%Y-%m-%d')")->result_array();
		// $pengeluaran_tanggal_list = $this->My_Model->get_data_order_group('pengeluaran', ['tanggal like' => '%'.date("Y-m").'%'], 'tanggal asc', "DATE_FORMAT(tanggal, '%Y-%m-%d')")->result_array();
		
		// if($transaksi_tanggal_list[0]['tanggal'] < $pengeluaran_tanggal_list[0]['tanggal']){
		// 	$start_date = date("Y-m-d", strtotime($transaksi_tanggal_list[0]['tanggal']));
		// }else{
		// 	$start_date = date("Y-m-d", strtotime($pengeluaran_tanggal_list[0]['tanggal']));
		// }
		// if(end($transaksi_tanggal_list)['tanggal'] > end($pengeluaran_tanggal_list)['tanggal']){
		// 	$end_date = date("Y-m-d", strtotime(end($transaksi_tanggal_list)['tanggal']));
		// }else{
		// 	$end_date = date("Y-m-d", strtotime(end($pengeluaran_tanggal_list)['tanggal']));
		// }
		$start_date = date("Y-m-01");
		$end_date = date('Y-m-t');;
		$spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
		$main_sheet = new \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet($spreadsheet, 'Main');
		$spreadsheet->removeSheetByIndex(0);
		$spreadsheet->addSheet($main_sheet);
		$main_sheet->setCellValue('A' . 1, 'TANGGAL');
		$main_sheet->setCellValue('B' . 1, 'PENDAPATAN');
		$main_sheet->setCellValue('C' . 1, 'PENGELUARAN');
		$main_sheet->setCellValue('D' . 1, 'BERSIH');

		$current_date = date("Y-m-d", strtotime($start_date));
		$sheet_per_bulan = new \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet($spreadsheet, date("Y-m"));
		$spreadsheet->addSheet($sheet_per_bulan);
		$sheet_per_bulan->setCellValue('A' . 1, 'PENJUALAN');
		$sheet_per_bulan->mergeCells('A1:E1');
		$sheet_per_bulan->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);;
		$sheet_per_bulan->setCellValue('A' . 2, 'NO');
		$sheet_per_bulan->setCellValue('B' . 2, 'TANGGAL');
		$sheet_per_bulan->setCellValue('C' . 2, 'KONSUMEN');
		$sheet_per_bulan->setCellValue('D' . 2, 'HARGA');
		$sheet_per_bulan->setCellValue('E' . 2, 'BARANG');

		$sheet_per_bulan->setCellValue('G' . 1, 'PENGELUARAN');
		$sheet_per_bulan->mergeCells('G1:M1');
		$sheet_per_bulan->getStyle('G1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
		$sheet_per_bulan->setCellValue('G' . 2, 'NO');
		$sheet_per_bulan->setCellValue('H' . 2, 'TANGGAL');
		$sheet_per_bulan->setCellValue('I' . 2, 'NAMA');
		$sheet_per_bulan->setCellValue('J' . 2, 'BARANG');
		$sheet_per_bulan->setCellValue('K' . 2, 'JUMLAH');
		$sheet_per_bulan->setCellValue('L' . 2, 'HARGA SATUAN');
		$sheet_per_bulan->setCellValue('M' . 2, 'HARGA TOTAL');
		$keys = 0;
		$row_transaksi = 3;
		$row_pengeluaran = 3;
		while ($current_date <= $end_date) {
			$transaksi = $this->My_Model->get_data_order('transaksi', ['tanggal like' => $current_date.'%'], 'tanggal asc')->result_array();
			$pengeluaran = $this->My_Model->get_data_order('pengeluaran', ['tanggal like' => $current_date.'%'], 'tanggal asc')->result_array();
			$no = 1;
			$total_pendapatan = 0;
			$data = [];
			foreach ($transaksi as $transaksi){
				$konsumen = $this->My_Model->get_data_simple('konsumen', ['id_konsumen' => $transaksi['konsumen_id']])->row();
				$barang = explode(',', $transaksi['barang_id']);
				$jumlah = explode(',', $transaksi['jumlah']);
				$table_barang = [];
				$total_pendapatan += $transaksi['total_harga'];
		
				foreach ($barang as $key => $barang) {
					$data_barang = $this->My_Model->get_data_simple('barang', ['barang_id' => $barang])->row();
					$table_barang[] = $data_barang->nama . ' ' . $data_barang->satuan . ' (' . $jumlah[$key] . ')';
				}
		
				$data[] = [
					'no' => $no++,
					'tanggal' => $transaksi['tanggal'],
					'konsumen' => $konsumen->nama_konsumen,
					'harga' => $transaksi['total_harga'],
					'barang' => implode("\n", $table_barang), // Menggunakan "\n" sebagai pemisah untuk data barang
				];
			}
			if($transaksi){
				foreach ($data as $row_data) {
					$col = 'A';
			
					foreach ($row_data as $key => $cell_data) {
						// tambahkan head menggunakan key
						$sheet_per_bulan->setCellValue($col . $row_transaksi, $cell_data);
						$col++;
					}
			
					$row_transaksi++;
				}
				$row_transaksi++;
			}
		

			$no = 1;
			$total_pengeluaran = 0;
			$data = [];
			foreach ($pengeluaran as $pengeluaran){
				$total_pengeluaran += $pengeluaran['harga_total'];

				$data[] = [
					'no' => $no++,
					'tanggal' => $pengeluaran['tanggal'],
					'nama' => $pengeluaran['nama_member'],
					'barang' => $pengeluaran['nama_barang'],
					'jumlah' => $pengeluaran['kuantitas'],
					'harga_satuan' => $pengeluaran['harga_satuan'],
					'harga_total' => $pengeluaran['harga_total'],
				];
			}

			if($pengeluaran){
				foreach ($data as $row_data) {
					$col = 'G';
			
					foreach ($row_data as $key => $cell_data) {
						// tambahkan head menggunakan key
						$sheet_per_bulan->setCellValue($col . $row_pengeluaran, $cell_data);
						$col++;
					}
			
					$row_pengeluaran++;
				}
				$row_pengeluaran++;
			}

			$main_sheet->setCellValue('A' . $keys+2, $current_date);
			$main_sheet->setCellValue('B' . $keys+2, $total_pendapatan);
			$main_sheet->setCellValue('C' . $keys+2, $total_pengeluaran);
			$main_sheet->setCellValue('D' . $keys+2, $total_pendapatan-$total_pengeluaran);
			$current_date = date("Y-m-d", strtotime($current_date . " +1 day"));
			$keys += 1;
		}
		// Save the modified Excel file
		$outputFileName = 'D:/Download/'.date("Y-m-d").'.xlsx';
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