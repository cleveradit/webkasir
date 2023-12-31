<?= $this->session->flashdata('pesan'); ?>

<div class="container-fluid">
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header">
					<a href="<?= base_url('pengeluaran/tambah') ?>" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Tambah</a>
				</div>
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
								<th>Action</th>
							</tr>
						</thead>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Modal edit -->
<?php foreach ($pengeluaran as $p) { ?>
	<div class="modal fade" id="upload<?= $p->id_pengeluaran ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Upload Nota</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form action="<?= base_url('pengeluaran/upload/' . $p->id_pengeluaran) ?>" method="POST" enctype="multipart/form-data">
						<div class="form-group">
							<label>Nota</label>
							<input type="file" name="nota_pengeluaran" class="custom-file" required>
							<?= form_error('nota_pengeluaran', '<div class="text-small text-danger">', '</div>'); ?>
						</div>
						<div class="modal-footer">
							<button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-save"></i> Simpan</button>
							<!-- <button type="reset" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Reset</button> -->
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
<?php } ?>
<!-- Modal view -->
<?php foreach ($pengeluaran as $p) { ?>
	<div class="modal fade" id="view<?= $p->id_pengeluaran ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Lihat Nota</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<img src="<?= base_url().$p->nota_pengeluaran ?>" alt="" style="max-width: 100%; height: auto;">
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" data-dismiss="modal" class="btn btn-secondary btn-sm"> Close</button>
					<!-- <button type="reset" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Reset</button> -->
				</div>
			</div>
		</div>
	</div>
<?php } ?>