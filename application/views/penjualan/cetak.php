<title><?= $file ?></title>
<link href="<?= base_url('asset/css/sb-admin-2.min.css') ?>" rel="stylesheet">

<?php $this->load->view('pesanan/styleCetak') ?>

<!-- Content Row -->
<div class="card-body">
    <table class="table table-borderless">
        <tr class="text-center">
            <td colspan="2">
                <p class="h3">Pesanan Laundry</p>
                <p class="h5">Tiara Laundry</p>
                <small>
                    Jl. Pondok Baru Timur 
                    RT. 12, RW. 11, No. 36, <br>
                    Jakarta Timur, 13770
                </small>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <div class="border-bottom border-primary"></div>
            </td>
        </tr>
        <tr>
            <td>
                <label>Kode Pesanan</label>
                <div class="form-control text-center">
                    <?= $data->kode_pesanan ?>
                </div>
            </td>
            <td>
                <label>Tanggal Pesanan</label>
                <div class="form-control text-center">
                    <?= $data->tanggal_pesanan ?>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <label>Jumlah Pesanan</label>
                <div class="form-control">
                    <span class="w-50 d-sm-inline-block">
                        Rp .
                    </span>
                    <span class="w-50 text-right d-sm-inline-block">
                        <?= number_format($data->jumlah_pesanan, 2) ?>
                    </span>
                </div>
</div>
</td>
</tr>
<tr>
    <td colspan="2">
        <label>Detail Pesanan :</label>
    </td>
</tr>
</table>
<!-- <td colspan="2"> -->
<table class="table table-bordered table-custom" width="100%" cellspacing="0">
    <thead>
        <tr class="text-center">
            <th width='5%'>No</th>
            <th width='10%'>Kode</th>
            <th>Barang</th>
            <th>Harga</th>
            <th width='5%'>Banyak</th>
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
                <td class="text-center"><?= $dlist->kode_barang ?></td>
                <td><?= $dlist->nama_barang ?> ( <?= $dlist->kategori_pesanan ?> )</td>
                <td>
                    <span class="w-50 d-sm-inline-block">
                        Rp .
                    </span>
                    <span class="w-50 text-right d-sm-inline-block">
                        <?= number_format($dlist->harga_barang_pesanan, 2) ?>
                    </span>
                </td>
                <td class="text-center"><?= $dlist->jumlah_barang_pesanan ?></td>
                <td>
                    <span class="w-50 d-sm-inline-block">
                        Rp .
                    </span>
                    <span class="w-50 text-right d-sm-inline-block">
                        <?= number_format($jum, 2) ?>
                    </span>
                </td>
            </tr>
        <?php
        }
        ?>
    </tbody>
</table>
</div>

<div class="border-footer border-bottom border-primary"></div>
<small class="page"><span class="page-number">Hal : </span></small>
<small class="footer"><i>Diakses pada <?= date('d F Y, H:i:s') ?></i></small>