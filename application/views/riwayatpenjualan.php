<?= $this->session->flashdata('pesan'); ?>
<div class="card">
		<div class="card-header">
			<a href="<?= base_url('riwayatpenjualan/print') ?>" class="btn btn-info btn-sm"><i class="fas fa-print"></i> Print</a>
			<a href="<?= base_url('riwayatpenjualan/export_excel') ?>" class="btn btn-info btn-sm"><i class="fas fa-file-excel"></i> Excel</a>
		</div>
    	<div class="card-body">
    	  <table id="penjualan" class="table table-hover">
        	<thead>
        		<tr class="text-center">
        		  <th>No</th>
        		  <th>Tanggal</th>
        		  <th>Konsumen</th>
        		  <th>Nama Barang</th>
        		  <th>Total Harga</th>
        		  <th>Total Bayar</th>
                  <th>Action</th>
        		</tr>
        	</thead>
        	<?php $no = 1;
        	foreach($penjualan as $p) : ?>
        		<tbody>
        			<tr class="text-center">
        			  <td><?= $no++ ?></td>
        			  <td><?= $p['tanggal'] ?></td>
        			  <td><?= $p['nama_konsumen'] ?></td>
        			  <td><?= $p['barang'] ?></td>
    	    		  <td><?= $p['total_harga'] ?></td>
    	    		  <td><?= $p['total_bayar'] ?></td>
	        		  <td>
	        		  	<a href="<?= base_url('riwayatpenjualan/delete/' . $p['transaksi_id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin akan menghapus data ini?')"><i class="fas fa-trash"></i></a>
	        		  </td>
        			</tr>
    		    </tbody>
    	    <?php endforeach ?>
        </table>
    </div>
</div>