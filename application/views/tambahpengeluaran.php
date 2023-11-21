<div class="card">
	<div class="card-header">
		<a href="<?= base_url('pengeluaran') ?>" class="btn btn-secondary btn-sm"><i class="fas fa-arrow-left"></i> Kembali</a>
	</div>
	<div class="card-body">
		<form action="<?= base_url('pengeluaran/tambah_aksi') ?>" method="POST">
			<div class="form-group">
				<label>Nama</label>
				<input type="text" name="nama_member" class="form-control" required>
				
			</div>
			<div id="form-asal">
				<div class="form-group">
					<label>Nama Barang</label>
					<input type="text" name="nama_barang[]" class="form-control" required>
					
				</div>
				<div class="form-group">
					<label>Kuantitas</label>
					<input type="number" name="kuantitas[]" class="form-control" required>
					
				</div>
				<div class="form-group">
					<label>Harga satuan</label>
					<input type="number" name="harga_satuan[]" class="form-control" required>
					
				</div>
			</div>
			<div id=form-dinamis>

			</div>
			<button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-save"></i> Simpan</button>
			<button type="reset" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Reset</button>
			<button type="button" class="btn btn-danger btn-sm" onclick="copyForm()"> Tambah Barang</button>
		</form>
	</div>
</div>