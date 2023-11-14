$(document).ready(function() {
	load_table();
    // setInterval(function() {
    //     load_table(); // Reload the table
    // }, 600000);
});

function copyForm(){
		$("#form-asal")
		.clone()
		.appendTo($("#form-dinamis"))
}

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
            url: base_url + 'Pengeluaran/load_data',
        },
        "columns": [
            {"data": "no"},
            {"data": "nama_member"},
            {"data": "nama_barang"},
            {"data": "kuantitas"},
            {"data": "harga_satuan"},
            {"data": "harga_total"},
            {"data": "tanggal"},
            {
                "render": function(data, type, row) {
                    return '<a href="" data-toggle="modal" data-target="#edit'+row.id_konsumen+'" class="text-blue mr-1"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path><path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path><path d="M16 5l3 3"></path></svg></a>'+
                    '<a href="' + base_url + 'pengeluaran/delete/' + row.id_pengeluaran + '" class="text-red" onclick="return confirm(`Apakah anda yakin akan menghapus data ini?`)"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M4 7l16 0"></path><path d="M10 11l0 6"></path><path d="M14 11l0 6"></path><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path></svg></a> ';
                },
                "orderable": false,
            },
        ],
        // "order": [
        //     [0, 'desc']
        // ],
        // "scrollX": true,
        "iDisplayLength": 10,
        "lengthMenu": [10, 25, 50, 100],  // Add more columnDefs as needed for other columns
    });
}