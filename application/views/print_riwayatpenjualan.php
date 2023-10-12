<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Print Riwayat penjualan</title>
    </head>
    <body>
        <table>
            <tr>
                <th>No.</th>
                <th>Tanggal</th>
                <th>Konsumen</th>
                <th>Nama Barang</th>
                <th>Total Harga</th>
                <th>Total Bayar</th>
            </tr>
            <?php $no = 1;
            foreach($riwayatpenjualan as $rp) : ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $rp->tanggal ?></td>
                <td><?= $rp->nama_konsumen ?></td>
                <td><?= $rp->barang ?></td>
                <td><?= $rp->total_harga ?></td>
                <td><?= $rp->total_bayar ?></td>
            </tr>
            <?php endforeach ?>
        </table>

        <script type="text/javascript">
            window.print();
        </script>
    </body>
</html>