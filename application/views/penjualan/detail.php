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
                    <h6 class="m-0 font-weight-bold text-primary">Detail Penjualan</h6>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-2">
                        <label>Kode Penjualan</label>
                        <div class="form-control free-form text-center">
                            <?= $data->kode_penjualan ?>
                        </div>
                    </div>

                    <div class="col-md-6 mb-2">
                        <label>Tanggal Penjualan</label>
                        <div class="form-control free-form text-center">
                            <?= $data->tanggal_penjualan ?>
                        </div>
                    </div>

                    <div class="col-md-12 mb-2">
                        <label>Jumlah Penjualan</label>
                        <div class="d-sm-flex align-items-center justify-content-between form-control free-form">
                            <span>Rp. </span>
                            <h6>
                                <?= number_format($data->jumlah_penjualan, 2) ?>
                            </h6>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <label>Detail Penjualan :</label>
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
                                        $jum = $dlist->harga_barang_penjualan * $dlist->jumlah_barang_penjualan;
                                        $total += $jum;
                                    ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $dlist->kode_barang ?></td>
                                            <td><?= $dlist->nama_barang ?> ( <?= $dlist->kategori_penjualan ?> )</td>
                                            <td>
                                                <div class="d-sm-flex align-items-center justify-content-between">
                                                    <span>Rp. </span>
                                                    <h6>
                                                        <?= number_format($dlist->harga_barang_penjualan, 2) ?>
                                                    </h6>
                                                </div>
                                            </td>
                                            <td><?= $dlist->jumlah_barang_penjualan ?></td>
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
                <a href="<?php echo base_url('penjualan') ?>" class="btn btn-secondary btn-icon-split btn-sm">
                    <span class="icon text-white-50">
                        <i class="fas fa-window-close"></i>
                    </span>
                    <span class="text">Tutup</span>
                </a>
            </div>
        </div>
    </div>
</div>