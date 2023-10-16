// create nota

function nota(jumlah) {
    let hasil = "",
        char = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789",
        total = char.length;
    for (var r = 0; r < jumlah; r++) hasil += char.charAt(Math.floor(Math.random() * total));
    return hasil
}

$("#nota").html(nota(15));


// keranjang
let isCetak = false,
    barang = [],
    transaksi = $("#transaksi").DataTable({
        responsive: true,
        lengthChange: false,
        searching: false,
        scrollX: true
    });

function reloadTable() {
    transaksi.ajax.reload()
}


// get barang
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

// generate harga barang
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

// tambah barang di keranjang
function addKeranjang() {
    $.ajax({
        url: base_url+"kasir/add_keranjang",
        type: "post",
        dataType: "json",
        data: {
            id: $("#barang").val()
        },
        success: res => {
            let barang_id = $("#barang").val(),
                kode = res.kode,
                nama = res.nama,
                satuan = res.satuan,
                jumlah = parseInt($("#jumlah").val()),
                harga = parseInt(res.harga),
                total = parseInt($("#total").html());

            let a = transaksi.rows().indexes().filter((a, t) => kode === transaksi.row(a).data()[0]);
            if (a.length > 0) {
                let row = transaksi.row(a[0]),
                    data = row.data();
                data[4] = data[4] + jumlah;
                row.data(data).draw();
                $("#total").html(total + harga * jumlah)
            } else {
                barang.push({
                    id: barang_id,
                    terjual: jumlah
                });
                transaksi.row.add([
                    kode,
                    nama,
                    satuan,
                    harga,
                    jumlah,
                    `<button name="${kode}" class="btn btn-sm btn-danger" onclick="remove('${kode}')">Hapus</btn>`
                ]).draw();
                $("#total").html(total + harga * jumlah);
                $("#jumlah").val("");
                $("#bayar").removeAttr("disabled")
            }
        }
    })
}

// hapus barang keranjang
function remove(nama) {
    let data = transaksi.row($("[name=" + nama + "]").closest("tr")).data(),
        jumlah = data[4],
        harga = data[3],
        total = parseInt($("#total").html());
        akhir = total - jumlah * harga
    $("#total").html(akhir);
    transaksi.row($("[name=" + nama + "]").closest("tr")).remove().draw();
    if (akhir < 1) {
        $("#bayar").attr("disabled", "disabled")
    }
}

// MODAL BAYAR
$("#tanggal").datetimepicker({
    format: "dd-mm-yyyy h:ii:ss"
});

$(".modal").on("show.bs.modal", () => {
    let now = moment().format("D-MM-Y H:mm:ss"),
        total = $("#total").html(),
        jumlah_uang = $('[name="jumlah_uang"').val();
    $("#tanggal").val(now), 
    $(".total_bayar").html(total), 
    $(".kembalian").html(Math.max(jumlah_uang - total, 0))
});

$("#konsumen").select2({
    placeholder: "Konsumen",
    ajax: {
        url: base_url+"kasir/get_konsumen",
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

$("#konsumen").change(function(){
    checkUang();
})

function kembalian() {
    let total = $("#total").html(),
        jumlah_uang = $('[name="jumlah_uang"').val(),
        diskon = $('[name="diskon"]').val();
    $(".kembalian").html(jumlah_uang - total - diskon);
    checkUang()
}

function checkUang() {
    let jumlah_uang = $('[name="jumlah_uang"').val(),
        total_bayar = parseInt($(".total_bayar").html()),
        konsumen = $('[name="konsumen"').val();
    if (jumlah_uang !== "" && jumlah_uang >= total_bayar && konsumen !== null) {
        $("#add").removeAttr("disabled");
        $("#cetak").removeAttr("disabled")
    } else {
        $("#add").attr("disabled", "disabled");
        $("#cetak").attr("disabled", "disabled")
    }
}

function bayar() {
    isCetak = false
}

function bayarCetak() {
    isCetak = true
}

$("#form").validate({
    errorElement: "span",
    errorPlacement: (err, el) => {
        err.addClass("invalid-feedback"), el.closest(".form-group").append(err)
    },
    submitHandler: () => {
        checkout()
    }
});

function checkout() {
    let data = transaksi.rows().data(),
        qty = [];
    $.each(data, (index, value) => {
        qty.push(value[4])
    });
    $.ajax({
        url: base_url+"kasir/checkout",
        type: "post",
        dataType: "json",
        data: {
            barang: JSON.stringify(barang),
            tanggal: $("#tanggal").val(),
            qty: JSON.stringify(qty), // Convert qty to JSON
            total_harga: $("#total").html(),
            total_bayar: $('[name="jumlah_uang"]').val(),
            diskon: $('[name="diskon"]').val(),
            konsumen: $("#konsumen").val(),
            nota: $("#nota").html()
        },
        success: res => {
            if (isCetak) {
                Swal.fire("Sukses", "Sukses Membayar", "success").
                    then(() => window.location.href = `${base_url+"kasir/cetak/"}${res}`)
            } else {
                Swal.fire("Sukses", "Sukses Membayar", "success").
                    then(() => window.location.reload())
            }
        },
        error: err => {
            console.log(err); // Optionally log the entire error object for more details
        }
    })
}

$(".modal").on("hidden.bs.modal", () => {
    $("#form")[0].reset();
    $("#form").validate().resetForm()
});