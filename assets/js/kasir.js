let isCetak = false,
    produk = [],
    transaksi = $("#transaksi").DataTable({
        responsive: true,
        lengthChange: false,
        searching: false,
        scrollX: true
    });

function reloadTable() {
    transaksi.ajax.reload()
}

$("#barang").select2({
    placeholder: "Barang",
    ajax: {
        url: base_url+"kasir/get_barang",
        type: "post",
        dataType: "json",
        data: params => ({
            nama: params.term
        }),
        processResults: res => ({
            results: res
        }),
        cache: true
    }
});

function getHargaBarang() {
    $.ajax({
        url: base_url+"kasir/get_harga_barang",
        type: "post",
        dataType: "json",
        data: {
            id: $("#barang").val()
        },
        success: res => {
            $("#harga").html(`Harga Satuan:  ${res.harga}`);
        },
        error: err => {
            console.log(err)
        }
    })
}

function addKeranjang() {
    $.ajax({
        url: base_url+"kasir/add_keranjang",
        type: "post",
        dataType: "json",
        data: {
            id: $("#barang").val()
        },
        success: res => {
            let kode = res.kode,
                nama = res.nama,
                satuan = res.satuan,
                jumlah = parseInt($("#jumlah").val()),
                harga = parseInt(res.harga),
                total = parseInt($("#total").html());

                produk.push({
                    id: kode,
                    terjual: jumlah
                });
                transaksi.row.add([
                    kode,
                    nama,
                    satuan,
                    harga,
                    jumlah,
                    `<button name="${kode}" class="btn btn-sm btn-danger" onclick="remove('${kode}')">Hapus</btn>`]).draw();
                $("#total").html(total + harga * jumlah);
                $("#jumlah").val("");
                // $("#tambah").attr("disabled", "disabled");
                $("#bayar").removeAttr("disabled")

            console.log(produk)
            console.log(transaksi)
        }
    })
}