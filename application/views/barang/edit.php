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
                    <h6 class="m-0 font-weight-bold text-primary">Perbaharui Barang</h6>
                </div>
            </div>
            <form method="POST" action="<?= base_url('barang/edit/' . $data->id_barang) ?>" enctype="multipart/form-data">
                <div class="card-body">
                    <?php
                    // Validasi error                    
                    if (validation_errors()) {
                        echo '<div class="alert alert-warning">' . validation_errors() . '</div>';
                    }
                    $this->load->view('layout/alert');
                    ?>
                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <label>Nama Barang</label>
                            <input type="text" class="form-control" name="nama_barang" required value="<?= set_value('nama_barang', $data->nama_barang) ?>">
                        </div>

                        <div class="col-md-6 mb-2">
                            <label>Kategori Barang</label>
                            <!-- <select name="id_kategori_barang" class="form-control" required>                                 -->
                            <?php
                            $options = array('Pilih kategori..');
                            foreach ($kategori as $katlist) {
                                $options[$katlist->id_kategori_barang] = $katlist->nama_kategori_barang;
                            }
                            $extra = array(                                
                                'class'            => 'form-control',
                            );
                            echo form_dropdown('id_kategori_barang', $options, set_value('id_kategori_barang', $data->id_kategori_barang), $extra)
                            ?>
                            <!-- </select> -->
                        </div>

                        <div class="col-md-6 mb-2">
                            <label>Harga Laundry</label>
                            <input type="text" class="form-control Float" name="harga_laundry_barang" required value="<?= set_value('harga_laundry_barang', $data->harga_laundry_barang) ?>">
                        </div>     
                        
                        <div class="col-md-6 mb-2">
                            <label>Harga Dry Clean</label>
                            <input type="text" class="form-control Float" name="harga_dry_barang" required value="<?= set_value('harga_dry_barang', $data->harga_dry_barang) ?>">
                        </div>     

                        <div class="col-md-12 mb-2">
                            <label>Update Barang</label>
                            <input type="file" onchange="showPict(this)" class="form-control-file" name="gambar_barang">
                        </div>

                        <div class="col-md-12">
                            <img id="preview" src="" alt="" class="rounded pict">
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-success btn-icon-split btn-sm">
                        <span class="icon text-white-50">
                            <i class="fas fa-save"></i>
                        </span>
                        <span class="text">Simpan</span>
                    </button>
                    <a href="<?php echo base_url('barang') ?>" class="btn btn-secondary btn-icon-split btn-sm">
                        <span class="icon text-white-50">
                            <i class="fas fa-window-close"></i>
                        </span>
                        <span class="text">Tutup</span>
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>