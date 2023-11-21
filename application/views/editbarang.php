<div class="card">
	<div class="card-header">
		<a href="<?= base_url('masterbarang') ?>" class="btn btn-secondary btn-sm"><i class="fas fa-arrow-left"></i> Kembali</a>
	</div>
	<div class="card-body">
		<form action="<?= base_url('masterbarang/edit_aksi/' . $masterbarang->barang_id) ?>" method="POST">
			<div class="form-group">
				<label>Nama</label>
				<input type="text" name="nama" class="form-control" value="<?= $masterbarang->nama ?>">
				<?= form_error('nama', '<div class="text-small text-danger">', '</div>'); ?>
			</div>
			<div class="form-group">
				<label>Kode</label>
				<input type="text" name="kode" class="form-control" value="<?= $masterbarang->kode ?>">
				<?= form_error('kode', '<div class="text-small text-danger">', '</div>'); ?>
			</div>
			<div class="form-group">
				<label>Satuan</label>
				<input type="text" name="satuan" class="form-control" value="<?= $masterbarang->satuan ?>">
				<?= form_error('satuan', '<div class="text-small text-danger">', '</div>'); ?>
			</div>
			<div class="form-group">
				<label>Harga</label>
				<input type="number" name="harga" class="form-control" value="<?= $masterbarang->harga ?>">
				<?= form_error('harga', '<div class="text-small text-danger">', '</div>'); ?>
			</div>
			<button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-save"></i> Simpan</button>
		</form>
	</div>
</div>