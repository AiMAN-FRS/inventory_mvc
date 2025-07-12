<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <div class="sb-sidenav-menu-heading">Menu</div>
                    <a class="nav-link" href="<?= base_url('dashboard'); ?>">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-gauge"></i></div>
                        Stock Barang <span class="badge badge-light ml-2"><?= $notif['total']; ?></span>
                    </a>

                    <a class="nav-link" href="<?= base_url('customer/cs_page'); ?>">
                        <div class="sb-nav-link-icon"><i class="fas fa-users mr-1"></i></div>
                        Customer
                    </a>

                    <div class="sb-sidenav-menu-heading">Interface</div>
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseInterface"
                            aria-expanded="false" aria-controls="collapseInterface">
                            <div class="sb-nav-link-icon"><i class="fa-solid fa-boxes-stacked"></i></div>
                            <span style="padding-left: 10px;">Transaksi Barang</span>
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseInterface" aria-labelledby="headingOne"
                            data-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="<?= base_url('masuk/barangmasuk'); ?>">Barang Masuk / In</a>
                                <a class="nav-link" href="<?= base_url('keluar/barangkeluar'); ?>">Barang Keluar / Out</a>
                            </nav>
                        </div>

                    <a class="nav-link" href="<?= base_url('admin/adminpage'); ?>">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-user-tie mr-1"></i></div>
                        Admin
                    </a>

                    <a class="nav-link" href="<?= base_url('login/logout'); ?>"><i class="fa-solid fa-arrow-right-from-bracket"></i>
                        <span style="padding-left: 10px;">Logout</span>
                    </a>
                </div>
            </div>            
                
            <div class="sb-sidenav-footer">
            	<div class="small">Logged in as: </div>
            	<i><?= $email; ?></i>
            </div>
        </nav>
    </div>
    <div id="layoutSidenav_content">
