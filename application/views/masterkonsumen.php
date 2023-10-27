<?= $this->session->flashdata('pesan'); ?>
<div class="card">
	<div class="card-header">
        <a href="<?= base_url('masterkonsumen/tambah') ?>" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Tambah</a>
		<!-- <a href="<?= base_url('masterkonsumen/excel') ?>" class="btn btn-success btn-sm"><i class="fas fa-file"></i> Export PDF</a> -->
    </div>
    	<!-- /.card-header -->
    	<div class="card-body">
    	  <table id="konsumen" class="table table-hover">
        	<thead>
        		<tr class="text-center">
        		  <th>No</th>
        		  <th>Nama</th>
        		  <th>Nopol</th>
        		  <th>Created at</th>
        		  <th>Action</th>
        		</tr>
        	</thead>
			<tbody class="text-center">
				
			</tbody>
        </table>
    </div>
</div>

<!-- Modal edit -->
<?php foreach($masterkonsumen as $mk) { ?>
<div class="modal fade" id="edit<?= $mk->id_konsumen ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url('masterkonsumen/edit/' . $mk->id_konsumen) ?>" method="POST">
	<div class="form-group">
		<label>Nama Konsumen</label>
		<input type="text" name="nama_konsumen" class="form-control" value="<?= $mk->nama_konsumen ?>">
		<?= form_error('nama_konsumen', '<div class="text-small text-danger">', '</div>'); ?>
	</div>
	<div class="form-group">
		<label>Nopol</label>
		<input type="text" name="nopol" class="form-control" value="<?= $mk->nopol ?>">
		<?= form_error('nopol', '<div class="text-small text-danger">', '</div>'); ?>
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