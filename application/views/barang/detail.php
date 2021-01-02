<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
    <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
</div>

<!-- Content Row -->
<div class="row">
    <div class="col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="d-sm-flex align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Detail Barang</h6>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-2">
                        <label>Nama Barang</label>
                        <input type="text" class="form-control" readonly value="<?= set_value('nama_barang', $data->nama_barang) ?>">
                    </div>

                    <div class="col-md-6 mb-2">
                        <label>Kategori Barang</label>
                        <input type="text" class="form-control" readonly value="<?= set_value('id_barang_barang', $kategori->nama_kategori_barang) ?>">
                    </div>

                    <div class="col-md-6 mb-2">
                        <label>Harga Laundry</label>
                        <input type="text" class="form-control Float" readonly value="<?= set_value('harga_laundry_barang', $data->harga_laundry_barang) ?>">
                    </div>                    

                    <div class="col-md-6 mb-2">
                        <label>Harga Dry Clean</label>
                        <input type="text" class="form-control Float" readonly value="<?= set_value('harga_dry_barang', $data->harga_dry_barang) ?>">
                    </div>                    

                    <div class="col-md-12 mb-2">
                        <label>Gambar Barang</label>
                        <div>
                            <img src="<?= base_url('asset/img/barang/' . $data->gambar_barang) ?>" alt="" class="rounded pict">
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-right">
                <a href="<?php echo base_url('barang') ?>" class="btn btn-secondary btn-icon-split btn-sm">
                    <span class="icon text-white-50">
                        <i class="fas fa-window-close"></i>
                    </span>
                    <span class="text">Tutup</span>
                </a>
            </div>
        </div>
    </div>
</div>