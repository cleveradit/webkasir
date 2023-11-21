<?= $this->session->flashdata('pesan'); ?>

<div class="container-fluid">
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header">
					<a href="<?= base_url('masterbarang/tambah') ?>" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Tambah</a>
				</div>
				<!-- /.card-header -->
				<div class="card-body">
					<table id="barang" class="table table-bordered table-hover">
						<thead>
							<tr>
								<th>No</th>
								<th>Nama</th>
								<th>Kode</th>
								<th>Satuan</th>
								<th>Harga</th>
								<th>Action</th>
							</tr>
						</thead>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>