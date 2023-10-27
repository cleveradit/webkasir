<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Cetak</title>
	<style>
		@page {
			size: 100mm auto; /* Atur ukuran kertas cetak */
			margin: 0; /* Atur margin (opsional) */
    	}
		page {
			font-size: 12px;
            page-break-before: always; /* Page break before each <page> element */
        }
	</style>
</head>
<body>
	<page style="margin: auto;">
		<br>
		<p style="font-size: 9px !important;">
		PT. Sumber Bukit Caringin <br>
		Jl. Pejaten No. 26, Lebak Mekar, Greged, Kab. Cirebon<br>
		halo.berkin@gmail.com<br>
		</p>
		<center>
			<table width="100%">
				<tr>
					<td><?php echo $nota ?></td>
					<td align="right"><?php echo $tanggal ?></td>
				</tr>
			</table>
			<hr>
			<table width="100%">
				<tr>
					<td width="20%">Barang</td>
					<td width="30%">Satuan</td>
					<td width="10%" align="right">Qty</td>
					<td align="right" width="17%">Harga</td>
				</tr>
				<?php foreach ($barang as $key): ?>
					<tr>
						<td><?php echo $key->nama ?></td>
						<td><?php echo $key->satuan ?></td>
						<td align="right"><?php echo $key->total ?></td>
						<td align="right"><?php echo $key->harga ?></td>
					</tr>
				<?php endforeach ?>
			</table>
			<hr>
			<table width="100%">
				<tr>
					<td width="76%" align="right">
						Harga Jual
					</td>
					<td width="23%" align="right">
						<?php echo $total ?>
					</td>
				</tr>
			</table>
			<hr>
			<table width="100%">
				<tr>
					<td width="76%" align="right">
						Total
					</td>
					<td width="23%" align="right">
						<?php echo $total ?>
					</td>
				</tr>
				<tr>
					<td width="76%" align="right">
						Bayar
					</td>
					<td width="23%" align="right">
						<?php echo $bayar ?>
					</td>
				</tr>
				<tr>
					<td width="76%" align="right">
						Kembalian
					</td>
					<td width="23%" align="right">
						<?php echo $kembalian ?>
					</td>
				</tr>
			</table>
			<br>
			Reward : <?= $bonus ?>
			<br>
			<br>
			Terima Kasih <br>
			PT. Sumber Bukit Caringin
		</center>
	</page>
	<page style="margin: auto;">
		<br>
		<p style="font-size: 9px !important;">
		PT. Sumber Bukit Caringin<br>
		Jl. Pejaten No. 26, Lebak Mekar, Greged, Kab. Cirebon<br>
		halo.berkin@gmail.com<br>
		</p>
		<center>
			<table width="100%">
				<tr>
					<td><?php echo $nota ?></td>
					<td align="right"><?php echo $tanggal ?></td>
				</tr>
			</table>
			<hr>
			<table width="100%">
				<tr>
					<td width="20%">Barang</td>
					<td width="30%">Satuan</td>
					<td width="10%" align="right">Qty</td>
					<td align="right" width="17%">Harga</td>
				</tr>
				<?php foreach ($barang as $key): ?>
					<tr>
						<td><?php echo $key->nama ?></td>
						<td><?php echo $key->satuan ?></td>
						<td align="right"><?php echo $key->total ?></td>
						<td align="right"><?php echo $key->harga ?></td>
					</tr>
				<?php endforeach ?>
			</table>
			<hr>
			<table width="100%">
				<tr>
					<td width="76%" align="right">
						Harga Jual
					</td>
					<td width="23%" align="right">
						<?php echo $total ?>
					</td>
				</tr>
			</table>
			<hr>
			<table width="100%">
				<tr>
					<td width="76%" align="right">
						Total
					</td>
					<td width="23%" align="right">
						<?php echo $total ?>
					</td>
				</tr>
				<tr>
					<td width="76%" align="right">
						Bayar
					</td>
					<td width="23%" align="right">
						<?php echo $bayar ?>
					</td>
				</tr>
				<tr>
					<td width="76%" align="right">
						Kembalian
					</td>
					<td width="23%" align="right">
						<?php echo $kembalian ?>
					</td>
				</tr>
			</table>
			<br>
			Reward : <?= $bonus ?>
			<br>
			<br>
			Terima Kasih <br>
			PT. Sumber Bukit Caringin
		</center>
	</page>
	<page style="margin: auto;">
		<br>
		<p style="font-size: 9px !important;">
		PT. Sumber Bukit Caringin<br>
		Jl. Pejaten No. 26, Lebak Mekar, Greged, Kab. Cirebon<br>
		halo.berkin@gmail.com<br>
		</p>
		<center>
			<table width="100%">
				<tr>
					<td><?php echo $nota ?></td>
					<td align="right"><?php echo $tanggal ?></td>
				</tr>
			</table>
			<hr>
			<table width="100%">
				<tr>
					<td width="20%">Barang</td>
					<td width="30%">Satuan</td>
					<td width="10%" align="right">Qty</td>
					<td align="right" width="17%">Harga</td>
				</tr>
				<?php foreach ($barang as $key): ?>
					<tr>
						<td><?php echo $key->nama ?></td>
						<td><?php echo $key->satuan ?></td>
						<td align="right"><?php echo $key->total ?></td>
						<td align="right"><?php echo $key->harga ?></td>
					</tr>
				<?php endforeach ?>
			</table>
			<hr>
			<table width="100%">
				<tr>
					<td width="76%" align="right">
						Harga Jual
					</td>
					<td width="23%" align="right">
						<?php echo $total ?>
					</td>
				</tr>
			</table>
			<hr>
			<table width="100%">
				<tr>
					<td width="76%" align="right">
						Total
					</td>
					<td width="23%" align="right">
						<?php echo $total ?>
					</td>
				</tr>
				<tr>
					<td width="76%" align="right">
						Bayar
					</td>
					<td width="23%" align="right">
						<?php echo $bayar ?>
					</td>
				</tr>
				<tr>
					<td width="76%" align="right">
						Kembalian
					</td>
					<td width="23%" align="right">
						<?php echo $kembalian ?>
					</td>
				</tr>
			</table>
			<br>
			Reward : <?= $bonus ?>
			<br>
			<br>
			Terima Kasih <br>
			PT. Sumber Bukit Caringin
		</center>
	</page>
	<script src="<?= base_url('assets/template') ?>/plugins/jquery/jquery.min.js"></script>
    <script>
    var base_url = '<?php echo base_url() ?>'
    </script>
	<script>

		$(document).ready(function() {
            // Calculate the height of each <page> and set it in the @page rule
            $('page').each(function(index, page) {
                var contentHeight = $(page).height()+40;
                var rule = '@page { size: 80mm ' + contentHeight + 'px; margin: 0; }';
				console.log(contentHeight);
				console.log(rule);
                $('style').append(rule);
            });

            // Initiate the print operation
            window.print();
        });
		
		// Menambahkan event listener untuk event afterprint
		if (window.matchMedia) {
			const mediaQueryList = window.matchMedia('print');
			mediaQueryList.addEventListener('change', (e) => {
				if (!e.matches) {
					window.location.href = base_url+"/kasir";
				}
			});
		}
	</script>
</body>
</html>
