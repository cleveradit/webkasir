$(document).ready(function() {
	load_table();
    $('#select-multiple').select2();
    $("select.form-select").each(function() {
        var selectId = $(this).attr("id");
        $('#'+selectId).select2();
        // Lakukan sesuatu dengan nilai-nilai yang dipilih dan ID masing-masing elemen
        console.log("ID: " + selectId);
    });
});
    
function load_table() {
    var table = $('#bonus').DataTable({
        "destroy": true,
        "processing": true,
        // "serverSide": true,
        "dom": 'frtip',
        // "buttons": [
        //     {
        //         extend: 'copy',
        //         text: 'Copy',
        //         className: 'custom-dataTables-button btn btn-sm',
        //     },
        //     {
        //         extend: 'excel',
        //         text: 'Excel',
        //         className: 'custom-dataTables-button btn btn-sm',
        //     },
        //     {
        //         extend: 'csv',
        //         text: 'CSV',
        //         className: 'custom-dataTables-button btn btn-sm',
        //     },
        //     {
        //         extend: 'print',
        //         text: 'Print',
        //         className: 'custom-dataTables-button btn btn-sm',
        //     },
        //     {
        //         extend: 'pdf',
        //         text: 'PDF',
        //         className: 'custom-dataTables-button btn btn-sm',
        //     }
        // ],
        "ajax": {
            url: base_url + 'MasterBonus/load_data',
        },
        "columns": [
            {"data": "no"},
            {"data": "barang"},
            {"data": "jumlah"},
            {"data": "hari"},
            {"data": "uang"},
            {"data": "status"},
            {
                "render": function(data, type, row) {
                    if(row.bonus_id){
                        return '<a href="' + base_url + 'masterbonus/edit/' + row.bonus_id + '" class="text-blue mr-1"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path><path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path><path d="M16 5l3 3"></path></svg></a>'+
                        '<a href="' + base_url + 'masterbonus/delete/' + row.bonus_id + '" class="text-red" onclick="return confirm(`Apakah anda yakin akan menghapus data ini?`)"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M4 7l16 0"></path><path d="M10 11l0 6"></path><path d="M14 11l0 6"></path><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path></svg></a> ';
                    }else{
                        return null
                    }
                },
                "orderable": false,
            },
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