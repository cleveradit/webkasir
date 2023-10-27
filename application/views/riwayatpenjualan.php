<?= $this->session->flashdata('pesan'); ?>
<div class="card">
		<!-- <div class="card-header">
			<a href="<?= base_url('riwayatpenjualan/print') ?>" class="btn btn-info btn-sm"><i class="fas fa-print"></i> Print</a>
			<a href="<?= base_url('riwayatpenjualan/export_excel') ?>" class="btn btn-info btn-sm"><i class="fas fa-file-excel"></i> Excel</a>
		</div> -->
    	<div class="card-body">
			<table id="penjualan" class="table table-hover">
				<thead>
					<tr class="text-center">
						<th></th>
						<th>Tanggal</th>
						<th>Konsumen</th>
						<th>Barang</th>
						<th></th>
						<th></th>
						<th></th>
					</tr>
					<tr class="text-center">
						<th>No</th>
						<th>Tanggal</th>
						<th>Konsumen</th>
						<th>Nama Barang</th>
						<th>Total Harga</th>
						<th>Total Bayar</th>
						<th>Action</th>
					</tr>
				</thead>
			</table>
    	</div>
</div>