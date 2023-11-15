<?= $this->session->flashdata('pesan'); ?>
<div class="card">
	<div class="card-header">
		<a href="<?= base_url('masterbonus/tambah') ?>" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Tambah</a>
	</div>
	<!-- /.card-header -->
	<div class="card-body">
		<table id="bonus" class="table table-hover">
			<thead>
				<tr class="text-center">
					<th>No</th>
					<th>Barang</th>
					<th>Jumlah</th>
					<th>Hari</th>
					<th>Reward</th>
					<th>Status</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody class="text-center">

			</tbody>
		</table>
	</div>
</div>

<!-- Modal edit -->
<?php foreach ($masterbonus as $mb) { ?>
	<div class="modal fade" id="edit<?= $mb['bonus_id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Edit Data</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form action="<?= base_url('masterbonus/edit/' . $mb['bonus_id']) ?>" method="POST">
						<div class="form-group">
							<label>Barang</label>
							<select class="form-select" id="select-multiple-edit-<?= $mb['bonus_id'] ?>" type="text" name="barang[]" multiple="multiple" style="width: 100%;">
								<?php foreach ($barang as $b) : ?>
									<?php 
									$selected = '';
									$b_array = explode(',', $mb['barang']) ;
									foreach ($b_array as $ba){
										if($ba==$b['barang_id']){
											$selected = 'selected';
										}
									}
									?>
									<option <?= $selected ?> value="<?= $b['barang_id'] ?>"><?= $b['nama'] ?> (<?= $b['satuan'] ?>)</option>
								<?php endforeach ?>
							</select>
						</div>
						<div class="form-group">
							<label>Jumlah</label>
							<input type="text" name="jumlah" class="form-control" value="<?= $mb['jumlah'] ?>">
						</div>
						<div class="form-group">
							<label>Hari</label>
							<input type="text" name="hari" class="form-control" value="<?= $mb['hari'] ?>">
						</div>
						<div class="form-group">
							<label>Reward</label>
							<input type="text" name="uang" class="form-control" value="<?= $mb['uang'] ?>">
						</div>
						<div class="form-group">
							<label>Status</label>
							<select name="status" class="form-control">
								<option <?= $mb['status']=='aktif' ? 'selected' : '' ?> value="aktif">aktif</option>
								<option <?= $mb['status']=='tidak aktif' ? 'selected' : '' ?> value="tidak aktif">tidak aktif</option>
							</select>
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