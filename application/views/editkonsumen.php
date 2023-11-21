<div class="card">
	<div class="card-header">
		<a href="<?= base_url('masterkonsumen') ?>" class="btn btn-secondary btn-sm"><i class="fas fa-arrow-left"></i> Kembali</a>
	</div>
	<div class="card-body">
		<form action="<?= base_url('masterkonsumen/edit_aksi/' . $masterkonsumen->id_konsumen) ?>" method="POST">
			<div class="form-group">
				<label>Nama Konsumen</label>
				<input type="text" name="nama_konsumen" class="form-control" value="<?= $masterkonsumen->nama_konsumen ?>">
				<?= form_error('nama_konsumen', '<div class="text-small text-danger">', '</div>'); ?>
			</div>
			<div class="form-group">
				<label>Nopol</label>
				<input type="text" name="nopol" class="form-control" value="<?= $masterkonsumen->nopol ?>">
				<?= form_error('nopol', '<div class="text-small text-danger">', '</div>'); ?>
			</div>
			<button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-save"></i> Simpan</button>
		</form>
	</div>
</div>