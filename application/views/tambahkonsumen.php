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
	<div class="form-group">
		<label>Saldo</label>
		<input type="text" name="saldo" class="form-control">
		<?= form_error('saldo', '<div class="text-small text-danger">', '</div>'); ?>
	</div>

	<button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-save"></i> Simpan</button>
	<button type="reset" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Reset</button>
</form>