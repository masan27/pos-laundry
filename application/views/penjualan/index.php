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
                    <h6 class="m-0 font-weight-bold text-primary">Penjualan</h6>
                    <!-- <a id="cetak-view" href="" target="_blank"></a> -->
                    <div class="row">
                        <label class="col-sm-5 col-form-label">Tarik Pesanan</label>
                        <div class="col-md-7">
                            <?php
                            $options = array('Pilih pesanan..');
                            foreach ($pesanan as $plist) {
                                $options[$plist->id_pesanan] = $plist->kode_pesanan . ' (Rp. ' . number_format($plist->jumlah_pesanan, 2) . ' )';
                            }
                            $extra = array(
                                'class'            => 'form-control',
                                'id'               => 'id-pesanan'
                            );
                            echo form_dropdown('id-pesanan', $options, set_value('id-pesanan'), $extra)
                            ?>
                        </div>
                    </div>
                    <a id="btn-tarik-data" onclick="" class="btn btn-secondary btn-sm">
                        <span class="icon text-white-50">
                            <i class="fas fa-sign-in-alt"></i>
                        </span>
                        <span class="text">Tarik Data</span>
                    </a>
                </div>
            </div>
            <div class="card-body">
                <?php $this->load->view('layout/alert'); ?>
                <div class="row">
                    <div class="col-md-3 border-right">
                        <div class="mb-4">
                            <label>Masukan Kode Barang</label>
                            <input id="barang_temp" type="text" maxlength="5" class="form-control text-center" name="barang_temp" value="">
                            <div class="text-right mt-1">
                                <a class="btn btn-info btn-icon-split btn-sm" data-toggle="modal" data-target="#barangModal">
                                    <span class="icon text-white-50">
                                        <i class="fas fa-search"></i>
                                    </span>
                                    <span class="text">Cari</span>
                                </a>
                            </div>
                        </div>
                        <form action="<?= base_url('temp/tambah') ?>" method="POST">
                            <div>
                                <label id="label">Keterangan</label>
                                <div id="nama-barang" class="form-control free-form mb-1"></div>
                                <div id="kategori" class="mb-1">
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Kategori</label>
                                        <div class="col-md-8">
                                            <select name="kat" id="kat-barang" required class="form-control" onchange="getBarang()">
                                                <option value="">Pilih Kategori..</option>
                                                <option value="L">Laundry</option>
                                                <option value="D">Dry Clean</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div id="harga-barang" class="form-control free-form mb-1"></div>
                                <div id="banyak-barang" class="mb-1">
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Jumlah</label>
                                        <div class="col-md-8">
                                            <input type="number" required class="form-control text-center" name="jumlah">
                                        </div>
                                    </div>
                                </div>
                                <img id="gambar-barang" class="mypap mb-3" src="" alt="gambar barang">
                                <input type="hidden" name="id_barang" id="id-barang" value="">
                                <input type="hidden" name="link" value="penjualan">
                            </div>
                            <div class="text-right">
                                <button type="submit" class="btn btn-success btn-icon-split btn-sm">
                                    <span class="icon text-white-50">
                                        <i class="fas fa-save"></i>
                                    </span>
                                    <span class="text">Tambahkan</span>
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-9">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th width='5%'>No</th>
                                        <th>Nama Barang</th>
                                        <th>Harga</th>
                                        <th>Banyak</th>
                                        <th>Jumlah</th>
                                        <th>&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    $total = 0;
                                    foreach ($temp as $tlist) {
                                        $jum = $tlist->harga_barang_temp * $tlist->banyak_barang_temp;
                                        $total += $jum;
                                    ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $tlist->nama_barang ?>( <?= $tlist->kategori_temp ?> )</td>
                                            <td><?= number_format($tlist->harga_barang_temp, 2) ?></td>
                                            <td><?= $tlist->banyak_barang_temp ?></td>
                                            <td><?= number_format($jum, 2) ?></td>
                                            <td class="text-center">
                                                <a title="Hapus" onclick="hapusData('<?= base_url('temp/hapus/' . $tlist->id_temp . '/penjualan') ?>')" class="btn btn-danger btn-icon-split btn-sm">
                                                    <span class="icon text-white-50">
                                                        <i class="fas fa-trash"></i>
                                                    </span>
                                                    <span class="text">Hapus</span>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="4">Total</td>
                                        <td><span id="total-temp"><?= number_format($total, 2) ?></span></td>
                                        <td class="text-center">
                                            <a title="Clear" onclick="clearData('<?= base_url('temp/clear/penjualan') ?>')" class="btn btn-danger btn-icon-split btn-sm">
                                                <span class="icon text-white-50">
                                                    <i class="fas fa-sync"></i>
                                                </span>
                                                <span class="text">Reset</span>
                                            </a>

                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <?php if ($temp) : ?>
                            <form action="<?= base_url('penjualan/tambah') ?>" id="form-tambah" method="POST">
                                <input type="hidden" id="jum" name="jum" value="<?= $total ?>">
                                <?php if (isset($id)) : ?>
                                    <input type="hidden" name="id" value="<?= $id ?>">
                                <?php endif; ?>
                                <div class="row mt-4">
                                    <label class="col-sm-5 col-form-label">Uang Bayar</label>
                                    <div class="col-md-7">
                                        <input type="text" class="form-control Float text-right" id="uang-bayar">
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-5 col-form-label">Kembalian</label>
                                    <div class="col-md-7 text-right">
                                        <input type="text" class="form-control text-right" readonly id="uang-kembalian">
                                    </div>
                                </div>
                                <a data-toggle="modal" data-target="#verifModal" class="btn btn-block btn-success mt-4">
                                    <span class="icon text-white-50">
                                        <i class="fas fa-shopping-basket"></i>
                                    </span>
                                    <span class="text">Buat Penjualan</span>
                                </a>
                            </form>
                        <?php endif; ?>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="d-sm-flex align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Daftar Penjualan</h6>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable2" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
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
                                            <a title="Detail" href="<?= base_url('penjualan/detail/' . $dlist->id_penjualan) ?>" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
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