<?= $this->session->flashdata('pesan'); ?>
<div class="card">
	<div class="card-header">
		<a href="<?= base_url('masterbonus/tambah') ?>" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Tambah</a>
	</div>
	<!-- /.card-header -->
	<div class="card-body">
		<table id="bonus" class="table table-hover">
			<thead>
				<tr class="text-center">
					<th>No</th>
					<th>Barang</th>
					<th>Jumlah</th>
					<th>Hari</th>
					<th>Reward</th>
					<th>Status</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody class="text-center">

			</tbody>
		</table>
	</div>
</div>