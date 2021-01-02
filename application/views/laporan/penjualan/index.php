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
                    <h6 class="m-0 font-weight-bold text-primary">Laporan Penjualan</h6>
                    <div class="row">
                        <label class="col-sm-2 col-form-label">Awal</label>
                        <div class="col-md-4">
                            <input type="date" id="awal" name="awal" class="form-control" value="<?= $awal ?>">
                        </div>
                        <label class="col-sm-2 col-form-label">Akhir</label>
                        <div class="col-md-4">
                            <input type="date" id="akhir" name="akhir" class="form-control" value="<?= $akhir ?>">
                        </div>
                    </div>
                    <a onclick="cariData()" class="d-none d-sm-inline-block btn btn-sm btn-primary btn-icon-split shadow-sm">
                        <span class="icon text-white-50">
                            <i class="fas fa-search"></i>
                        </span>
                        <span class="text">Cari</span>
                    </a>
                    <a href="<?= base_url('laporanpenjualan/cetak?awal='.$awal.'&akhir='.$akhir) ?>" target="_blank" class="d-none d-sm-inline-block btn btn-sm btn-primary btn-icon-split shadow-sm">
                        <span class="icon text-white-50">
                            <i class="fas fa-print"></i>
                        </span>
                        <span class="text">Cetak Laporan</span>
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th width='5%'>No</th>
                                <th>Kode</th>
                                <th>Tanggal</th>
                                <th>Jumlah</th>
                                <th>&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($data as $dlist) {
                            ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $dlist->kode_penjualan ?></td>
                                    <td><?= $dlist->tanggal_penjualan ?></td>
                                    <td>
                                        <div class="d-sm-flex align-items-center justify-content-between">
                                            <span>Rp. </span>
                                            <h6>
                                                <?= number_format($dlist->jumlah_penjualan, 2) ?>
                                            </h6>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group">
                                            <a title="Detail" href="<?= base_url('laporanpenjualan/detail/' . $dlist->id_penjualan) ?>" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>