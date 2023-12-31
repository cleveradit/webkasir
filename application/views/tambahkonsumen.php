<div class="card">
	<div class="card-header">
		<a href="<?= base_url('masterkonsumen') ?>" class="btn btn-secondary btn-sm"><i class="fas fa-arrow-left"></i> Kembali</a>
	</div>
	<div class="card-body">
		<form action="<?= base_url('masterkonsumen/tambah_aksi') ?>" method="POST">
			<div class="form-group">
				<label>Nama Konsumen</label>
				<input type="text" name="nama_konsumen" class="form-control">
				<?= form_error('nama_konsumen', '<div class="text-small text-danger">', '</div>'); ?>
			</div>
			<div class="form-group">
				<label>Nopol</label>
				<input type="text" name="nopol" class="form-control">
				<?= form_error('nopol', '<div class="text-small text-danger">', '</div>'); ?>
			</div>
			<button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-save"></i> Simpan</button>
			<button type="reset" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Reset</button>
		</form>
	</div>
</div>