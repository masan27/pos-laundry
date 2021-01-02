<title><?= $file ?></title>
<link href="<?= base_url('asset/css/sb-admin-2.min.css') ?>" rel="stylesheet">

<?php $this->load->view('pesanan/styleCetak') ?>

<!-- Content Row -->
<div class="card-body">
    <table class="table table-borderless">
        <tr class="text-center">
            <td colspan="4">
                <p class="h3">Laporan Pesanan <?=$jenis?></p>
                <p>(<small><?= $awal ?> - <?= $akhir ?></small>)</p>
                <p class="h5">Tiara Laundry</p>
                <small>
                    Jl. Pondok Baru Timur 
                    RT. 12, RW. 11, No. 36, <br>
                    Jakarta Timur, 13770
                </small>
            </td>
        </tr>
    </table>

    <table class="table table-bordered table-custom" width="100%" cellspacing="0">>
        <tr>
            <th width='5%'>No</th>
            <th>Kode</th>
            <th>Tanggal</th>
            <th>Jumlah</th>
            <th width='5%'>Lunas</th>
            <th width='5%'>Void</th>
        </tr>
        <?php
        $no = 1;
        foreach ($data as $dlist) {
        ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $dlist->kode_pesanan ?></td>
                <td><?= $dlist->tanggal_pesanan ?></td>
                <td>
                    <span class="w-50 d-sm-inline-block">
                        Rp .
                    </span>
                    <span class="w-50 text-right d-sm-inline-block">
                        <?= number_format($dlist->jumlah_pesanan, 2) ?>
                    </span>
                </td>
                <td><?= ($dlist->proses_pesanan) ? 'Y' : ''; ?></td>
                <td><?= ($dlist->void_pesanan) ? 'Y' : ''; ?></td>
            </tr>
        <?php } ?>
    </table>
</div>

<div class="border-footer border-bottom border-primary"></div>
<small class="page"><span class="page-number">Hal : </span></small>
<small class="footer"><i>Diakses pada <?= date('d F Y, H:i:s') ?></i></small>