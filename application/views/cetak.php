<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Cetak</title>
	<style>
		@page {
			size: 80mm auto; /* Atur ukuran kertas cetak */
			margin: 0; /* Atur margin (opsional) */
    	}
	</style>
</head>
<body>
	<div style="width: 302px; margin: auto;">
		<br>
		<center>
			Toko Material Tambang<br>
			Jl. Pemalang XXX<br><br>
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
			Target reward : <?= $bonus ?>
			<br>
			<br>
			Terima Kasih <br>
			Toko Material Tambang
		</center>
	</div>
    <script>
    var base_url = '<?php echo base_url() ?>'
    </script>
	<script>
		// Loop untuk mencetak 3 halaman
		for (let i = 0; i < 3; i++) {
			if (i > 0) {
				// Tambahkan halaman baru setelah cetakan pertama
				document.write('<page></page>');
			}
			window.print();
		}
		
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
