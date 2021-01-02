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
                    <h6 class="m-0 font-weight-bold text-primary">Perbaharui Profile</h6>
                </div>
            </div>
            <form method="POST" action="<?= base_url('pengguna/profil/' . $data->id_user) ?>" enctype="multipart/form-data">
                <div class="card-body">
                    <?php
                    // Validasi error                    
                    if (validation_errors()) {
                        echo '<div class="alert alert-warning">' . validation_errors() . '</div>';
                    }
                    $this->load->view('layout/alert');
                    ?>
                    <div class="row">
                        <div class="col-md-12 mb-2">
                            <label>Username</label>
                            <input type="text" class="form-control" name="username" required value="<?= set_value('username', $data->username) ?>">
                        </div>

                        <div class="col-md-12 mb-2">
                            <label>Nama Pengguna</label>
                            <input type="text" class="form-control" name="nama_user" required value="<?= set_value('nama_user', $data->nama_user) ?>">
                        </div>

                        <div class="col-md-12 mb-2">
                            <label>Password</label>
                            <input type="password" placeholder="Kosongkan password apabila tidak mengubah password" class="form-control" name="password" minlength="5" value="<?= set_value('password') ?>">
                        </div>

                        <div class="col-md-12 mb-2">
                            <label>Jabatan</label>
                            <!-- <select name="id_kategori_barang" class="form-control" required>                                 -->
                            <?php
                            $options = array('Pilih jabatan..');
                            $options['admin'] = 'Admin';
                            $options['user'] = 'Karyawan';

                            $extra = array(
                                'class'            => 'form-control',
                            );
                            echo form_dropdown('role', $options, set_value('role', $data->role), $extra)
                            ?>
                            <!-- </select> -->
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
                    <a href="<?php echo base_url('kategoribarang') ?>" class="btn btn-secondary btn-icon-split btn-sm">
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