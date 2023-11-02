<form action="<?= base_url('pengeluaran') ?>" method="POST">
	<div class="form-group">
		<label>Nama</label>
		<input type="text" name="nama" class="form-control">
		<?= form_error('nama', '<div class="text-small text-danger">', '</div>'); ?>
	</div>
	<div class="form-group">
		<label>Nama Barang</label>
		<input type="text" name="nama_barang" class="form-control">
		<?= form_error('nama_barang', '<div class="text-small text-danger">', '</div>'); ?>
	</div>
	<div class="form-group">
		<label>Kuantitas</label>
		<input type="text" name="kuantitas" class="form-control">
		<?= form_error('kuantitas', '<div class="text-small text-danger">', '</div>'); ?>
	</div>
	<div class="form-group">
		<label>Harga satuan</label>
		<input type="text" name="harga_satuan" class="form-control">
		<?= form_error('harga_satuan"', '<div class="text-small text-danger">', '</div>'); ?>
	</div>
	<div class="form-group">
		<label>Harga total</label>
		<input type="text" name="nopol" class="form-control">
		<?= form_error('nopol', '<div class="text-small text-danger">', '</div>'); ?>
	</div>

	<button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-save"></i> Simpan</button>
	<button type="reset" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Reset</button>
</form>

<div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                    <h3 class="card-title">DataTable with minimal features & hover style</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example2" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                            <th>Rendering engine</th>
                            <th>Browser</th>
                            <th>Platform(s)</th>
                            <th>Engine version</th>
                            <th>CSS grade</th>
                            </tr>
                        </thead>
                        </table>
                    </div>
                    </div>
                </div>
        </div>
</div>