<div class="modal fade" id="barangModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Daftar Barang</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="barangTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th width='5%'>No</th>
                                <th>Gambar</th>
                                <th>Kode</th>
                                <th>Nama</th>
                                <th>Laundry</th>
                                <th>Dry</th>
                                <th>&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($barang as $blist) { ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><img class="img-fluid mypap" src="<?= base_url('asset/img/barang/' . $blist->gambar_barang) ?>" alt=""></td>
                                    <td class="text-center"><?= $blist->kode_barang ?></td>
                                    <td><?= $blist->nama_barang ?></td>
                                    <td>
                                        <div class="d-sm-flex align-items-center justify-content-between">
                                            <span>Rp. </span>
                                            <h6>
                                                <?= number_format($blist->harga_laundry_barang, 2) ?>
                                            </h6>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-sm-flex align-items-center justify-content-between">
                                            <span>Rp. </span>
                                            <h6>
                                                <?= number_format($blist->harga_dry_barang, 2) ?>
                                            </h6>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group">
                                            <a title="Pilih" onclick="pilihBarang('<?= $blist->kode_barang ?>')" class="btn btn-info btn-icon-split btn-sm">
                                                <span class="icon text-white-50">
                                                    <i class="fas fa-mouse-pointer"></i>
                                                </span>
                                                <span class="text">Pilih</span>
                                            </a>
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
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="clearModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Apakah Anda Yakin?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                Pilih lanjut untuk melakukan proses menghapus seluruh daftar saat ini
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Tutup</button>
                <a id="btn-clear" href="" class="btn btn-danger">Lanjut
                </a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="voidModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Apakah Anda Yakin?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="" id="form-void" method="POST">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <label>Alasan Void</label>
                            <textarea name="alasan" required class="form-control"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Batalkan</button>
                    <button type="submit" class="btn btn-danger" >Void</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="verifModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Apakah Anda Yakin?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                Pilih lanjut untuk melakukan proses Pesanan                
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Batalkan</button>
                <button type="submit" form="form-tambah" class="btn btn-primary">Lanjut</button>
            </div>
        </div>
    </div>
</div>