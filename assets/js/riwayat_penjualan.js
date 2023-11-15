$(document).ready(function() {
	load_table();
    // setInterval(function() {
    //     load_table(); // Reload the table
    // }, 10000);
    // executeTaskAt1005();
});

// function runDownloadExcel() {
//     $.ajax({
//         url: base_url + 'RiwayatPenjualan/download_excel', // Ganti dengan jalur yang benar
//         method: 'GET',
//         success: function(response) {
//             console.log('Fungsi download_excel dijalankan.');
//         },
//         error: function() {
//             console.error('Gagal menjalankan download_excel.');
//         }
//     });
// }

// Fungsi untuk menjalankan tugas pada pukul 10:05
// function executeTaskAt1005() {
//     var now = new Date();
//     var targetTime = new Date(now.getFullYear(), now.getMonth(), now.getDate(), 16, 0, 0); // Atur waktu target

//     var currentTime = now.getTime();
//     var targetTimeMs = targetTime.getTime();
//     var delay = targetTimeMs - currentTime;

//     if (delay < 0) {
//         targetTime.setDate(targetTime.getDate() + 1);
//         delay = targetTime - currentTime;
//     }

//     setTimeout(function() {
//         runDownloadExcel(); // Jalankan fungsi download_excel
//         setInterval(executeTaskAt1005, 24 * 60 * 60 * 1000); // Setiap 24 jam
//     }, delay);
// }

// Jalankan fungsi executeTaskAt1005 untuk pertama kali
// executeTaskAt1005();
    
function load_table() {
    var table = $('#penjualan').DataTable({
        "destroy": true,
        "processing": true,
        // "serverSide": true,
        "dom": 'Bfrtip',
        "buttons": [
            {
                extend: 'copy',
                text: 'Copy',
                className: 'custom-dataTables-button btn btn-sm',
            },
            {
                text: 'Main Excel',
                className: 'custom-dataTables-button btn btn-sm',
                action: function ( e, dt, button, config ) {
                  window.location = base_url+'RiwayatPenjualan/download_excel_new';
                }        
            },
            {
                extend: 'excel',
                text: 'Excel',
                className: 'custom-dataTables-button btn btn-sm',
            },
            {
                extend: 'csv',
                text: 'CSV',
                className: 'custom-dataTables-button btn btn-sm',
            },
            {
                extend: 'print',
                text: 'Print',
                className: 'custom-dataTables-button btn btn-sm',
            },
            {
                extend: 'pdf',
                text: 'PDF',
                className: 'custom-dataTables-button btn btn-sm',
            }
        ],
        "ajax": {
            url: base_url + 'RiwayatPenjualan/load_data',
        },
        "columns": [
            {"data": "no"},
            {"data": "tanggal"},
            {"data": "nama_konsumen"},
            {"data": "barang"},
            {"data": "total_harga"},
            {"data": "total_bayar"},
            {
                "render": function(data, type, row) {
                    return '<a href="#" data-id="' + row.transaksi_id + '" class="text-blue print-transaksi"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-printer" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2"></path><path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4"></path><path d="M7 13m0 2a2 2 0 0 1 2 -2h6a2 2 0 0 1 2 2v4a2 2 0 0 1 -2 2h-6a2 2 0 0 1 -2 -2z"></path></svg></a>';
                            // '<a href="#" data-id="' + row.transaksi_id + '" class="text-red delete-transaksi"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M4 7l16 0"></path><path d="M10 11l0 6"></path><path d="M14 11l0 6"></path><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path></svg></a>';
                },
                "orderable": false,
            },
        ],
        "order": [
            [1, 'desc']
        ],
        // "scrollX": true,
        "iDisplayLength": 10,
        "lengthMenu": [10, 25, 50, 100],  // Add more columnDefs as needed for other columns
    });

    $('#penjualan').on('click', '.delete-transaksi', function(e) {
        e.preventDefault();
        var deleteLink = $(this).attr('data-id');
        
		Swal.fire({
            title: 'Konfirmasi Penghapusan',
            text: 'Apakah Anda yakin ingin menghapus transaksi ini?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, Hapus',
            cancelButtonText: 'Batal',
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: base_url + 'RiwayatPenjualan/delete/' + deleteLink,
                    type: 'DELETE',
                    success: function(response) {
                        load_table();
                        Swal.fire('Sukses!', 'Data transaksi telah dihapus.', 'success');
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                        Swal.fire('Error', 'Gagal menghapus data transaksi.', 'error');
                    }
                });
            }
        });
    });

    $('#penjualan').on('click', '.print-transaksi', function(e) {
        e.preventDefault();
        var printLink = $(this).attr('data-id');
        window.location.href = `${base_url+"kasir/cetak/"}${printLink}`
        // $.ajax({
        //     url: base_url + 'kasir/cetak/' + printLink,
        //     type: 'GET',
        // });
    });

    // $('#penjualan thead').prepend($('#penjualan thead tr:eq(1)').clone(true));
    // $('#penjualan thead tr').clone(true).appendTo('#penjualan thead');
    $('#penjualan thead tr:eq(0) th').each(function(i) {
        if (i == 1 || i == 2 || i == 3) { 
            $(this).removeClass('sorting_desc');
            $(this).removeClass('sorting');
            var title = $(this).text();
            $(this).html('<input type="text" placeholder="' + title + '" />');

            $('input', this).on('keyup change', function() {
                if (table.column(i).search() !== this.value) {
                    table
                        .column(i)
                        .search(this.value)
                        .draw();
                }
            });
        }else{
            $(this).html('');
            $(this).removeClass('sorting_desc');
            $(this).removeClass('sorting');
        }
    });

    // $('#penjualan thead tr').clone(true).appendTo('#penjualan thead');
    // $('#penjualan thead').prepend($('#penjualan thead tr:eq(1)').clone(true));
    // $('#penjualan thead tr:eq(1) th:eq(0), #penjualan thead tr:eq(1) th:eq(4), #penjualan thead tr:eq(1) th:eq(5), #penjualan thead tr:eq(1) th:eq(6)').each(function(i) {
    //     $(this).html('');
    //     $(this).removeClass('sorting_desc');
    //     $(this).removeClass('sorting');
    // });
    // $('#penjualan thead tr:eq(1) th:eq(1), #penjualan thead tr:eq(1) th:eq(2), #penjualan thead tr:eq(1) th:eq(3)').each(function(i) {
    //     $(this).removeClass('sorting_desc');
    //     $(this).removeClass('sorting');
    //     var title = $(this).text();
    //     $(this).html('<input type="text" placeholder="' + title + '" />');

    //     $('input', this).on('keyup change', function() {
    //         if (table.column(i).search() !== this.value) {
    //             table
    //                 .column(i)
    //                 .search(this.value)
    //                 .draw();
    //         }
    //     });
    // });
}