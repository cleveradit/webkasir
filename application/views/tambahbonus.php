<form action="<?= base_url('masterbonus/tambah_aksi') ?>" method="POST">
	<div class="form-group">
		<label>Barang</label>
		<select class="form-select" id="select-multiple" type="text" name="barang[]" multiple="multiple" style="width: 100%;">
            <?php foreach ($barang as $b): ?>
                <option value="<?= $b['barang_id'] ?>"><?= $b['nama'] ?> (<?= $b['satuan'] ?>)</option>
            <?php endforeach ?>
        </select>
	</div>
	<div class="form-group">
		<label>Jumlah</label>
		<input type="text" name="jumlah" class="form-control">
	</div>
	<div class="form-group">
		<label>Hari</label>
		<input type="text" name="hari" class="form-control">
	</div>
	<div class="form-group">
		<label>Reward</label>
		<input type="text" name="uang" class="form-control">
	</div>
	<div class="form-group">
		<label>Status</label>
		<select name="status" class="form-control">
			<option value="null">pilih</option>
			<option value="aktif">aktif</option>
			<option value="tidak aktif">tidak aktif</option>
		</select>
	</div>

	<button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-save"></i> Simpan</button>
	<button type="reset" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Reset</button>
</form>