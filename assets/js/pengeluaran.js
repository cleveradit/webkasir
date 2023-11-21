$(document).ready(function() {
	load_table();
    // setInterval(function() {
    //     load_table(); // Reload the table
    // }, 600000);
    // let form_error = $(".text-small.text-danger").html()
    // if(form_error!='' && form_error!=undefined){
    //     $("#tambah").modal("show");
    // }
});

function copyForm(){
    $("#form-asal")
		.clone()
		.appendTo($("#form-dinamis"))
    // var clonedForm = $("#form-asal").clone();
        
    // // Increment index for each form field in the cloned section
    // var index = $("#form-dinamis > div").length; // Get the current number of cloned sections
    // clonedForm.find('[name^="nama_barang"]').attr('name', 'nama_barang[' + index + ']');
    // clonedForm.find('[name^="kuantitas"]').attr('name', 'kuantitas[' + index + ']');
    // clonedForm.find('[name^="harga_satuan"]').attr('name', 'harga_satuan[' + index + ']');

    // // Update form error messages with the correct indices
    // clonedForm.find('.text-danger').each(function() {
    //     var originalMessage = $(this).html();
    //     var newIndex = index;
    //     var newMessage = originalMessage.replace(/\[0\]/g, '[' + newIndex + ']');
    //     $(this).html(newMessage);
    // });

    // clonedForm.appendTo($("#form-dinamis"));
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
                    if(row.id_pengeluaran){
                        if(row.nota_pengeluaran!=null){
                            return '<a href="" data-toggle="modal" data-target="#view'+row.id_pengeluaran+'" class="text-blue mr-1"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-eye" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" /></svg></a>'+
                            '<a href="' + base_url + 'pengeluaran/delete/' + row.id_pengeluaran + '" class="text-red" onclick="return confirm(`Apakah anda yakin akan menghapus data ini?`)"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M4 7l16 0"></path><path d="M10 11l0 6"></path><path d="M14 11l0 6"></path><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path></svg></a> ';
                        }else{
                            return '<a href="" data-toggle="modal" data-target="#upload'+row.id_pengeluaran+'" class="text-blue mr-1"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-upload" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2" /><path d="M7 9l5 -5l5 5" /><path d="M12 4l0 12" /></svg></a>'+
                            '<a href="' + base_url + 'pengeluaran/delete/' + row.id_pengeluaran + '" class="text-red" onclick="return confirm(`Apakah anda yakin akan menghapus data ini?`)"><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M4 7l16 0"></path><path d="M10 11l0 6"></path><path d="M14 11l0 6"></path><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path></svg></a> ';
                        }
                    }else{
                        return null
                    }
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