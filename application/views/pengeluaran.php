<form action="<?= base_url('pengeluaran/tambah_aksi') ?>" method="POST">
	<div class="form-group">
		<label>Nama</label>
		<input type="text" name="nama_member" class="form-control">
		<?= form_error('nama_member', '<div class="text-small text-danger">', '</div>'); ?>
	</div>
	<div class="form-group">
		<label>Nama Barang</label>
		<input type="text" name="nama_barang" class="form-control">
		<?= form_error('nama_barang', '<div class="text-small text-danger">', '</div>'); ?>
	</div>
	<div class="form-group">
		<label>Kuantitas</label>
		<input type="number" name="kuantitas" class="form-control">
		<?= form_error('kuantitas', '<div class="text-small text-danger">', '</div>'); ?>
	</div>
	<div class="form-group">
		<label>Harga satuan</label>
		<input type="number" name="harga_satuan" class="form-control">
		<?= form_error('harga_satuan"', '<div class="text-small text-danger">', '</div>'); ?>
	</div>
	<div class="form-group">
		<label>Harga total</label>
		<input type="text" name="harga_total" class="form-control">
		<?= form_error('harga_total', '<div class="text-small text-danger">', '</div>'); ?>
	</div>

	<button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-save"></i> Simpan</button>
	<button type="reset" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Reset</button>
</form>

<div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                    <h3 class="card-title">Data Pengeluaran</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="pengeluaran" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Nama Barang</th>
                            <th>Kuantitas</th>
                            <th>Harga Satuan</th>
                            <th>Harga Total</th>
                            </tr>
                        </thead>
                        </table>
                    </div>
                    </div>
                </div>
        </div>
</div>