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