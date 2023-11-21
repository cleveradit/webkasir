<div class="card">
	<div class="card-header">
		<a href="<?= base_url('masterbarang') ?>" class="btn btn-secondary btn-sm"><i class="fas fa-arrow-left"></i> Kembali</a>
	</div>
	<div class="card-body">
		<form action="<?= base_url('MasterBarang/tambah_aksi') ?>" method="POST">
			<div class="form-group">
				<label>Nama</label>
				<input type="text" name="nama" class="form-control">
				<?= form_error('nama', '<div class="text-small text-danger">', '</div>'); ?>
			</div>
			<div class="form-group">
				<label>Kode</label>
				<input type="text" name="kode" class="form-control">
				<?= form_error('kode', '<div class="text-small text-danger">', '</div>'); ?>
			</div>
			<div class="form-group">
				<label>Satuan</label>
				<input type="text" name="satuan" class="form-control">
				<?= form_error('satuan', '<div class="text-small text-danger">', '</div>'); ?>
			</div>
			<div class="form-group">
				<label>Harga</label>
				<input type="number" name="harga" class="form-control">
				<?= form_error('harga', '<div class="text-small text-danger">', '</div>'); ?>
			</div>

			<button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-save"></i> Simpan</button>
			<button type="reset" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Reset</button>
		</form>
	</div>
</div>