<style>
    @media(max-width: 576px){
        .nota{
            justify-content: center !important;
            text-align: center !important;
        }
    }
    .select2-container .select2-selection--single {
        height: calc(2.25rem + 2px);
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 36px;
    }
</style>

<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Barang</label>
                    <div class="form-inline">
                        <select id="barang" class="form-control select2 col-sm-6" onchange="getHargaBarang()"></select>
                        <span class="ml-3 text-muted" id="nama_barang"></span>
                    </div>
                    <small class="form-text text-muted" id="harga"></small>
                </div>
                <div class="form-group">
                    <label>Jumlah</label>
                    <input type="number" class="form-control col-sm-6" placeholder="Jumlah" id="jumlah">
                </div>
                <div class="form-group">
                    <button id="tambah" class="btn btn-sm btn-success" onclick="addKeranjang()" disabled>Tambah</button>
                    <button id="bayar" class="btn btn-sm btn-info" data-toggle="modal" data-target="#modal"
                        disabled>Bayar</button>
                </div>
            </div>
            <div class="col-sm-6 d-flex justify-content-end text-right nota">
                <div>
                    <div class="mb-0">
                        <b class="mr-2">Nota</b> <span id="nota"></span>
                    </div>
                    <span id="total" style="font-size: 80px; line-height: 1" class="text-danger">0</span>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <table class="table w-100 table-hover" id="transaksi">
            <thead>
                <tr>
                    <th>Kode</th>
                    <th>Nama</th>
                    <th>Satuan</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Id Barang</th>
                    <th>Actions</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<div class="modal fade" id="modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Bayar</h5>
                <button class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form">
                    <input type="hidden" name="bonus_id" id="bonus_id">
                    <input type="hidden" name="status" id="status">
                    <div class="form-group">
                        <label>Tanggal</label>
                        <input type="text" class="form-control" name="tanggal" id="tanggal" required>
                    </div>
                    <div class="form-group">
                        <label>Konsumen</label>
                        <select name="konsumen" id="konsumen" class="form-control select2"></select>
                    </div>
                    <div class="form-group">
                        <label>Jumlah Uang</label>
                        <input placeholder="Jumlah Uang" type="number" class="form-control" name="jumlah_uang"
                            onkeyup="kembalian()" required>
                    </div>
                    <div class="form-group">
                        <label>Bonus</label>
                        <input placeholder="Bonus" type="text" class="form-control"
                            name="bonus" id="bonus" readonly>
                    </div>
                    <div class="form-group">
                        <b>Total Bayar:</b> <span class="total_bayar"></span>
                    </div>
                    <div class="form-group">
                        <b>Kembalian:</b> <span class="kembalian"></span>
                    </div>
                    <button id="add" class="btn btn-sm btn-success" type="submit" onclick="bayar()"
                        disabled>Bayar</button>
                    <button id="cetak" class="btn btn-sm btn-info" type="submit" onclick="bayarCetak()" disabled>Bayar Dan Cetak</button>
                    <button class="btn btn-sm btn-danger" data-dismiss="modal">Close</button>
                </form>
            </div>
        </div>
    </div>
</div>