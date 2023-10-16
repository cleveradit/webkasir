$(document).ready(function() {
	load_table();
});
    
function load_table() {
    $('#penjualan').DataTable({
        destroy: true,
        "processing": true,
        // "serverSide": true,
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'copy',
                text: 'Copy',
                className: 'custom-dataTables-button btn btn-sm', // Apply custom CSS class
            },
            {
                extend: 'excel',
                text: 'Excel',
                className: 'custom-dataTables-button btn btn-sm', // Apply custom CSS class
            },
            {
                extend: 'csv',
                text: 'CSV',
                className: 'custom-dataTables-button btn btn-sm', // Apply custom CSS class
            },
            {
                extend: 'print',
                text: 'Print',
                className: 'custom-dataTables-button btn btn-sm', // Apply custom CSS class
            },
            {
                extend: 'pdf',
                text: 'PDF',
                className: 'custom-dataTables-button btn btn-sm', // Apply custom CSS class
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
                    return '<a href="#" data-id="' + row.transaksi_id + '" class="text-red delete-transaksi"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M4 7l16 0"></path><path d="M10 11l0 6"></path><path d="M14 11l0 6"></path><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path></svg></a>';
                },
                "orderable": false,
            },
        ],
        "order": [
            [1, 'desc']
        ],
        // "scrollX": true,
        "iDisplayLength": 10,
        "lengthMenu": [10, 25, 50, 100],
        
    });

    $('#penjualan').on('click', '.delete-transaksi', function(e) {
        e.preventDefault();
        var deleteLink = $(this).attr('data-id');
        console.log(deleteLink)
        
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
}