<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('dashboard') ?>">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Tiara <sup>Laundry</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item ">
        <a class="nav-link" href="<?= base_url('dashboard') ?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Interface
    </div>

    <li class="nav-item <?php echo strstr($this->uri->uri_string(), '/pesanan') ? 'active' : '' ?>">
        <a class="nav-link" href="<?php echo site_url('pesanan') ?>">
            <i class="fas fa-fw fa-edit"></i>
            <span>Pesanan</span>
        </a>
    </li>

    <li class="nav-item <?php echo strstr($this->uri->uri_string(), '/penjualan') ? 'active' : '' ?>">
        <a class="nav-link" href="<?php echo site_url('penjualan') ?>">
            <i class="fas fa-fw fa-shopping-basket"></i>
            <span>Penjualan</span>
        </a>
    </li>

    <?php if ($this->session->role == 'admin') : ?>

        <!-- Nav Item - Master Collapse Menu -->
        <li class="nav-item <?php echo strstr($this->uri->uri_string(), 'master_') ? 'active' : '' ?>">
            <a class="nav-link <?php echo strstr($this->uri->uri_string(), 'master_') ? '' : 'collapsed' ?>" href="#" data-toggle="collapse" data-target="#collapseMaster" aria-expanded="true" aria-controls="collapseMaster">
                <i class="fas fa-fw fa-server"></i>
                <span>Master Data</span>
            </a>
            <div id="collapseMaster" class="collapse <?php echo strstr($this->uri->uri_string(), 'master_') ? 'show' : '' ?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item <?php echo strstr($this->uri->uri_string(), 'barang') ? 'active' : '' ?>" href="<?php echo site_url('barang') ?>">Barang</a>
                    <a class="collapse-item <?php echo strstr($this->uri->uri_string(), 'kategoribarang') ? 'active' : '' ?>" href="<?php echo site_url('kategoribarang') ?>">Kategori Barang</a>
                    <a class="collapse-item <?php echo strstr($this->uri->uri_string(), 'pengguna') ? 'active' : '' ?>" href="<?php echo site_url('pengguna') ?>">Pengguna</a>
                </div>
            </div>
        </li>

        <!-- Nav Item - Master Collapse Menu -->
        <li class="nav-item <?php echo strstr($this->uri->uri_string(), 'lap_') ? 'active' : '' ?>">
            <a class="nav-link <?php echo strstr($this->uri->uri_string(), 'lap_') ? '' : 'collapsed' ?>" href="#" data-toggle="collapse" data-target="#collapseLap" aria-expanded="true" aria-controls="collapseLap">
                <i class="fas fa-fw fa-file-alt"></i>
                <span>Laporan</span>
            </a>
            <div id="collapseLap" class="collapse <?php echo strstr($this->uri->uri_string(), 'lap_') ? 'show' : '' ?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item <?php echo strstr($this->uri->uri_string(), 'laporanpesanan') ? 'active' : '' ?>" href="<?php echo site_url('laporanpesanan') ?>">Pesanan</a>
                    <a class="collapse-item <?php echo strstr($this->uri->uri_string(), 'laporanpenjualan') ? 'active' : '' ?>" href="<?php echo site_url('laporanpenjualan') ?>">Penjualan</a>
                </div>
            </div>
        </li>

    <?php endif; ?>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

    <!-- Sidebar Message -->
    <!-- <div class="sidebar-card">
        <img class="sidebar-card-illustration mb-2" src="img/undraw_rocket.svg" alt="">
        <p class="text-center mb-2"><strong>SB Admin Pro</strong> is packed with premium features, components, and more!</p>
        <a class="btn btn-success btn-sm" href="https://startbootstrap.com/theme/sb-admin-pro">Upgrade to Pro!</a>
    </div> -->

</ul>