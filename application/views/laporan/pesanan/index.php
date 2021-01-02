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
                    <h6 class="m-0 font-weight-bold text-primary">Laporan Pesanan</h6>
                    <a href="<?= base_url('laporanpesanan/cetak?awal=' . $awal . '&akhir=' . $akhir . '&jenis=' . $jenis) ?>" target="_blank" class="d-none d-sm-inline-block btn btn-sm btn-primary btn-icon-split shadow-sm">
                        <span class="icon text-white-50">
                            <i class="fas fa-print"></i>
                        </span>
                        <span class="text">Cetak Laporan</span>
                    </a>
                </div>
                <div class="d-sm-flex align-items-center justify-content-between mt-2">
                    <div class="row">
                        <label class="col-md-1 col-form-label">Awal</label>
                        <div class="col-md-3">
                            <input type="date" id="awal" name="awal" class="form-control" value="<?= $awal ?>">
                        </div>
                        <label class="col-md-1 col-form-label">Akhir</label>
                        <div class="col-md-3">
                            <input type="date" id="akhir" name="akhir" class="form-control" value="<?= $akhir ?>">
                        </div>
                        <label class="col-md-1 col-form-label">Jenis</label>
                        <div class="col-md-3">
                            <select id="jenis" class="form-control">
                                <option value="">Tampilkan semua</option>
                                <option <?= ($jenis == 'V') ? 'selected' : '' ?> value="V">Void</option>
                                <option <?= ($jenis == 'L') ? 'selected' : '' ?> value="L">Sudah Bayar</option>
                                <option <?= ($jenis == 'B') ? 'selected' : '' ?> value="B">Belum Bayar</option>
                            </select>
                        </div>
                    </div>
                    <a onclick="cariData()" class="d-none d-sm-inline-block btn btn-sm btn-primary btn-icon-split shadow-sm">
                        <span class="icon text-white-50">
                            <i class="fas fa-search"></i>
                        </span>
                        <span class="text">Cari</span>
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
                                <th width='5%'>Lunas</th>
                                <th width='5%'>Void</th>
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
                                    <td><?= $dlist->kode_pesanan ?></td>
                                    <td><?= $dlist->tanggal_pesanan ?></td>
                                    <td>
                                        <div class="d-sm-flex align-items-center justify-content-between">
                                            <span>Rp. </span>
                                            <h6>
                                                <?= number_format($dlist->jumlah_pesanan, 2) ?>
                                            </h6>
                                        </div>
                                    </td>
                                    <td><?= ($dlist->proses_pesanan) ? 'Y' : ''; ?></td>
                                    <td><?= ($dlist->void_pesanan) ? 'Y' : ''; ?></td>
                                    <td class="text-center">
                                        <div class="btn-group">
                                            <a title="Detail" href="<?= base_url('laporanpesanan/detail/' . $dlist->id_pesanan) ?>" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
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