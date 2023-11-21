<div class="card">
	<div class="card-header">
		<a href="<?= base_url('masterbonus') ?>" class="btn btn-secondary btn-sm"><i class="fas fa-arrow-left"></i> Kembali</a>
	</div>
	<div class="card-body">
		<form action="<?= base_url('masterbonus/edit_aksi/' . $masterbonus->bonus_id) ?>" method="POST">
			<div class="form-group">
				<label>Barang</label>
				<select class="form-select" id="select-multiple-edit-<?= $masterbonus->bonus_id ?>" type="text" name="barang[]" multiple="multiple" style="width: 100%;">
					<?php foreach ($barang as $b) : ?>
						<?php
						$selected = '';
						$b_array = explode(',', $masterbonus->barang);
						foreach ($b_array as $ba) {
							if ($ba == $b['barang_id']) {
								$selected = 'selected';
							}
						}
						?>
						<option <?= $selected ?> value="<?= $b['barang_id'] ?>"><?= $b['nama'] ?> (<?= $b['satuan'] ?>)</option>
					<?php endforeach ?>
				</select>
				<?= form_error('barang[0]', '<div class="text-small text-danger">', '</div>'); ?>
			</div>
			<div class="form-group">
				<label>Jumlah</label>
				<input type="text" name="jumlah" class="form-control" value="<?= $masterbonus->jumlah ?>">
				<?= form_error('jumlah', '<div class="text-small text-danger">', '</div>'); ?>
			</div>
			<div class="form-group">
				<label>Hari</label>
				<input type="text" name="hari" class="form-control" value="<?= $masterbonus->hari ?>">
				<?= form_error('hari', '<div class="text-small text-danger">', '</div>'); ?>
			</div>
			<div class="form-group">
				<label>Reward</label>
				<input type="text" name="uang" class="form-control" value="<?= $masterbonus->uang ?>">
				<?= form_error('uang', '<div class="text-small text-danger">', '</div>'); ?>
			</div>
			<div class="form-group">
				<label>Status</label>
				<select name="status" class="form-control">
					<option <?= $masterbonus->status == 'aktif' ? 'selected' : '' ?> value="aktif">aktif</option>
					<option <?= $masterbonus->status == 'tidak aktif' ? 'selected' : '' ?> value="tidak aktif">tidak aktif</option>
				</select>
				<?= form_error('status', '<div class="text-small text-danger">', '</div>'); ?>
			</div>
			<button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-save"></i> Simpan</button>
		</form>
	</div>
</div>