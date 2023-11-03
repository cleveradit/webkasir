$(document).ready(function() {
	load_table();
    setInterval(function() {
        load_table(); // Reload the table
    }, 600000);
});


function load_table() {
    var table = $('#pengeluaran').DataTable({
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
            url: base_url + 'Pengeluaran/load_data',
        },
        "columns": [
            {"data": "no"},
            {"data": "nama_member"},
            {"data": "nama_barang"},
            {"data": "kuantitas"},
            {"data": "harga_satuan"},
            {"data": "harga_total"},
            // {
            //     "render": function(data, type, row) {
            //         return '<a href="#" data-id="' + row.konsumen_id + '" class="text-blue print-transaksi"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-printer" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2"></path><path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4"></path><path d="M7 13m0 2a2 2 0 0 1 2 -2h6a2 2 0 0 1 2 2v4a2 2 0 0 1 -2 2h-6a2 2 0 0 1 -2 -2z"></path></svg></a>'+
            //                 '<a href="#" data-id="' + row.konsumen_id + '" class="text-red delete-transaksi"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M4 7l16 0"></path><path d="M10 11l0 6"></path><path d="M14 11l0 6"></path><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path></svg></a>';
            //     },
            //     "orderable": false,
            // },
        ],
        // "order": [
        //     [0, 'desc']
        // ],
        // "scrollX": true,
        "iDisplayLength": 10,
        "lengthMenu": [10, 25, 50, 100],  // Add more columnDefs as needed for other columns
    });
}