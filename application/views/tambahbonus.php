<div class="card">
	<div class="card-header">
		<a href="<?= base_url('masterbonus') ?>" class="btn btn-secondary btn-sm"><i class="fas fa-arrow-left"></i> Kembali</a>
	</div>
	<div class="card-body">
		<form action="<?= base_url('masterbonus/tambah_aksi') ?>" method="POST">
			<div class="form-group">
				<label>Barang</label>
				<select class="form-select" id="select-multiple" type="text" name="barang[]" multiple="multiple" style="width: 100%;">
					<?php foreach ($barang as $b) : ?>
						<option value="<?= $b['barang_id'] ?>"><?= $b['nama'] ?> (<?= $b['satuan'] ?>)</option>
					<?php endforeach ?>
				</select>
				<?= form_error('barang[0]', '<div class="text-small text-danger">', '</div>'); ?>
			</div>
			<div class="form-group">
				<label>Jumlah</label>
				<input type="text" name="jumlah" class="form-control">
				<?= form_error('jumlah', '<div class="text-small text-danger">', '</div>'); ?>
			</div>
			<div class="form-group">
				<label>Hari</label>
				<input type="text" name="hari" class="form-control">
				<?= form_error('hari', '<div class="text-small text-danger">', '</div>'); ?>
			</div>
			<div class="form-group">
				<label>Reward</label>
				<input type="text" name="uang" class="form-control">
				<?= form_error('uang', '<div class="text-small text-danger">', '</div>'); ?>
			</div>
			<div class="form-group">
				<label>Status</label>
				<select name="status" class="form-control">
					<option value="aktif">aktif</option>
					<option value="tidak aktif">tidak aktif</option>
				</select>
				<?= form_error('status', '<div class="text-small text-danger">', '</div>'); ?>
			</div>

			<button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-save"></i> Simpan</button>
			<button type="reset" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Reset</button>
		</form>
	</div>
</div>