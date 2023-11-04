<div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Tambah data</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="<?= base_url('pengeluaran/tambah_aksi') ?>" method="POST">
					<div class="form-group">
						<label>Nama</label>
						<input type="text" name="nama_member" class="form-control">
						<?= form_error('nama_member', '<div class="text-small text-danger">', '</div>'); ?>
					</div>
					<div class="form-group">
						<label>Nama Barang</label>
						<input type="text" name="nama_barang" class="form-control">
						<?= form_error('nama_barang', '<div class="text-small text-danger">', '</div>'); ?>
					</div>
					<div class="form-group">
						<label>Kuantitas</label>
						<input type="number" name="kuantitas" class="form-control">
						<?= form_error('kuantitas', '<div class="text-small text-danger">', '</div>'); ?>
					</div>
					<div class="form-group">
						<label>Harga satuan</label>
						<input type="number" name="harga_satuan" class="form-control">
						<?= form_error('harga_satuan"', '<div class="text-small text-danger">', '</div>'); ?>
					</div>

					<button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-save"></i> Simpan</button>
					<button type="reset" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Reset</button>
				</form>
			</div>
		</div>
	</div>
</div>

	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-header">
						<a href="#" data-toggle="modal" data-target="#tambah" class="btn btn-sm btn-primary mr-1">Tambah</a>
					</div>
					<!-- /.card-header -->
					<div class="card-body">
						<table id="pengeluaran" class="table table-bordered table-hover">
							<thead>
								<tr>
									<th>No</th>
									<th>Nama</th>
									<th>Nama Barang</th>
									<th>Kuantitas</th>
									<th>Harga Satuan</th>
									<th>Harga Total</th>
									<th>Tanggal</th>
								</tr>
							</thead>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>