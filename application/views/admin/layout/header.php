<body>
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <!-- Header top area start-->
    <div class="header-top-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="admin-logo">
                        <!-- <a href="#"><img src="<?= base_url(); ?>assets/templates/admin/img/logo/log.png" alt="" />
                        </a> -->
                        <h5 style="color: white; font-weight:bolder; font-size:25px;">Sistem <span style="color: #03a9f0;">Pakar</span></h5>
                    </div>
                </div>
                <div class="col-lg-5 col-md-5 col-sm-0 col-xs-12">
                    <div class="header-top-menu">
                        <ul class="nav navbar-nav mai-top-nav">
                            <li class="nav-item"><a href="<?= base_url(); ?>admin/dashboard" class="nav-link">Dashboard</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle">Master Data <span class="angle-down-topmenu"><i class="fa fa-angle-down"></i></span></a>
                                <div role="menu" class="dropdown-menu animated flipInX">
                                    <!-- <a href="<?= base_url(); ?>admin/pasien" class="dropdown-item">Data Pasien</a> -->
                                    <a href="<?= base_url(); ?>admin/gejala" class="dropdown-item">Data Gejala</a>
                                    <a href="<?= base_url(); ?>admin/alergi" class="dropdown-item">Data Alergi</a>
                                </div>
                            </li>
                            <li class="nav-item"><a href="<?= base_url(); ?>admin/aturan" class="nav-link">aturan</a>
                            </li>
                            <li class="nav-item"><a href="<?= base_url(); ?>admin/riwayat" class="nav-link">Riwayat</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-9 col-sm-6 col-xs-12">
                    <div class="header-right-info">
                        <ul class="nav navbar-nav mai-top-nav header-right-menu">
                            <li class="nav-item">
                                <a href="<?= base_url('auth/logout') ?>" role="button" aria-expanded="false" class="nav-link dropdown-toggle">
                                    <span class="adminpro-icon adminpro-locked header-riht-inf"></span>
                                    <span class="admin-name">Log Out</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Header top area end-->

    <!-- Main Menu area start-->
    <div class="main-menu-area mg-tb-40">
        <div class="container">
            
        </div>
    </div>
    <!-- Main Menu area End-->
    <!-- Mobile Menu start -->
    <div class="mobile-menu-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="mobile-menu">
                        <nav id="dropdown">
                            <ul class="mobile-menu-nav">
                                <li><a href="<?= base_url(); ?>admin/dashboard">Dashboard <span class="admin-project-icon adminpro-icon adminpro-down-arrow"></span></a>
                                </li>
                                <li><a data-toggle="collapse" data-target="#dataMaster" href="#">Data Master <span class="admin-project-icon adminpro-icon adminpro-down-arrow"></span></a>
                                    <ul id="dataMaster" class="collapse dropdown-header-top">
                                        <li><a href="<?= base_url(); ?>admin/pasien">Data Pasien</a>
                                        </li>
                                        <li><a href="<?= base_url(); ?>admin/gejala">Data Gejala</a>
                                        </li>
                                        <li><a href="<?= base_url(); ?>admin/alergi">Data Alergi</a>
                                        </li>
                                    </ul>
                                </li>
                                <li><a href="<?= base_url(); ?>admin/aturan">Aturan <span class="admin-project-icon adminpro-icon adminpro-down-arrow"></span></a>
                                </li>
                                <li><a href="<?= base_url(); ?>admin/riwayat">Riwayat <span class="admin-project-icon adminpro-icon adminpro-down-arrow"></span></a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Mobile Menu end -->