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
                    <h6 class="m-0 font-weight-bold text-primary">Daftar Pengguna</h6>
                    <a href="<?= base_url('pengguna/tambah') ?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                        <i class="fas fa-download fa-sm text-white-50"></i>
                        Tambah Pengguna
                    </a>
                </div>
            </div>
            <div class="card-body">
                <?php $this->load->view('layout/alert'); ?>
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th width='5%'>No</th>                                
                                <th>Username</th>
                                <th>Nama</th>
                                <th>Jabatan</th>
                                <th>&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($data as $list) { ?>
                                <tr>
                                    <td><?= $no++ ?></td>                                                                        
                                    <td><?= $list->username ?></td>                                    
                                    <td><?= $list->nama_user ?></td>                                    
                                    <td><?= $list->role ?></td>                                    
                                    <td class="text-center">
                                        <div class="btn-group">
                                            <a title="Edit" href="<?php echo base_url('pengguna/edit/') . $list->id_user ?>" class="btn btn-info btn-sm btn-warning"><i class="far fa-edit"></i></a>
                                            <a title="Hapus" onclick="hapusData('<?php echo base_url('pengguna/hapus/' . $list->id_user) ?>')" href="#!" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
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
</div>