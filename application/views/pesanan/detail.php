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
                    <h6 class="m-0 font-weight-bold text-primary">Detail Pesanan</h6>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-2">
                        <label>Kode Pesanan</label>
                        <div class="form-control free-form text-center">
                            <?= $data->kode_pesanan ?>
                        </div>
                    </div>

                    <div class="col-md-6 mb-2">
                        <label>Tanggal Pesanan</label>
                        <div class="form-control free-form text-center">
                            <?= $data->tanggal_pesanan ?>
                        </div>
                    </div>

                    <div class="col-md-12 mb-2">
                        <label>Jumlah Pesanan</label>
                        <div class="d-sm-flex align-items-center justify-content-between form-control free-form">
                            <span>Rp. </span>
                            <h6>
                                <?= number_format($data->jumlah_pesanan, 2) ?>
                            </h6>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <label>Detail Pesanan :</label>
                    </div>

                    <div class="col-md-12 mb-2">
                        <div class="table-responsive">
                            <table class="table table-bordered" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th width='5%'>No</th>
                                        <th>Kode Barang</th>
                                        <th>Nama Barang</th>
                                        <th>Harga</th>
                                        <th>Banyak</th>
                                        <th>Jumlah</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    $total = 0;
                                    foreach ($detail as $dlist) {
                                        $jum = $dlist->harga_barang_pesanan * $dlist->jumlah_barang_pesanan;
                                        $total += $jum;
                                    ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $dlist->kode_barang ?></td>
                                            <td><?= $dlist->nama_barang ?> ( <?= $dlist->kategori_pesanan ?> )</td>
                                            <td>
                                                <div class="d-sm-flex align-items-center justify-content-between">
                                                    <span>Rp. </span>
                                                    <h6>
                                                        <?= number_format($dlist->harga_barang_pesanan, 2) ?>
                                                    </h6>
                                                </div>
                                            </td>
                                            <td><?= $dlist->jumlah_barang_pesanan ?></td>
                                            <td>
                                                <div class="d-sm-flex align-items-center justify-content-between">
                                                    <span>Rp. </span>
                                                    <h6>
                                                        <?= number_format($jum, 2) ?>
                                                    </h6>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-right">
                <a href="<?php echo base_url('pesanan/cetak/' . $data->id_pesanan) ?>" target="_blank" class="btn btn-primary btn-icon-split btn-sm">
                    <span class="icon text-white-50">
                        <i class="fas fa-print"></i>
                    </span>
                    <span class="text">Cetak Ulang</span>
                </a>
                <a href="<?php echo base_url('pesanan') ?>" class="btn btn-secondary btn-icon-split btn-sm">
                    <span class="icon text-white-50">
                        <i class="fas fa-window-close"></i>
                    </span>
                    <span class="text">Tutup</span>
                </a>
            </div>
        </div>
    </div>
</div>