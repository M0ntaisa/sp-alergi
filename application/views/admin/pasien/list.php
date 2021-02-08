<!-- stockprice, feed area start-->
<!-- <div class="login-form-area">
        <div class="container">
            <div class="row">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-md-6 col-sm-12 col-xs-12">
                            <div class="sparkline7-list stock-price-section shadow-reset nt-mg-b-30">
                                <div class="sparkline7-hd">
                                    <div class="main-spark7-hd">
                                        <h1>Tambah Data Gejala</h1>
                                        <div class="sparkline8-outline-icon">
                                            <span class="sparkline8-collapse-link"><i class="fa fa-chevron-up"></i></span>
                                            <span><i class="fa fa-wrench"></i></span>
                                            <span class="sparkline8-collapse-close"><i class="fa fa-times"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="sparkline7-graph">
                                    <div class="dashone-bar-heading">

                                        <a class="btn btn-success" href="#" data-toggle="modal" data-target="#addPasien" style="color:white;"><i class="fa fa-plus"></i> Tambah Data</a>
                                        
                                        <div id="addPasien" class="modal modal-adminpro-general default-popup-PrimaryModal fade" role="dialog">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header header-color-modal bg-color-1">
                                                        <h4 class="modal-title">Tambah Data Gejala</h4>
                                                        <div class="modal-close-area modal-close-df">
                                                            <a class="close" data-dismiss="modal" href="#"><i class="fa fa-close"></i></a>
                                                        </div>
                                                    </div>
                                                    <div class="modal-body">
                                                        <?= form_open(base_url('admin/gejala/tambah_gejala')); ?>
                                                        <?php $kode_gejala = count($gejala)+1; ?>
                                                            <div class="form-group-inner">
                                                                <div class="row">
                                                                    <div class="col-lg-4">
                                                                        <label class="login2">Kode Gejala</label>
                                                                    </div>
                                                                    <div class="col-lg-8">
                                                                        <input name="kode_gejala" type="text" class="form-control" value="<?= 'GA'.$kode_gejala ?>" readonly />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group-inner">
                                                                <div class="row">
                                                                    <div class="col-lg-4">
                                                                        <label class="login2">Gejala</label>
                                                                    </div>
                                                                    <div class="col-lg-8">
                                                                        <textarea class="form-control" name="gejala" id="gejala" cols="30" rows="5"></textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="login-btn-inner">
                                                                <div class="row">
                                                                    <div class="col-lg-9"></div>
                                                                    <div class="col-lg-3">
                                                                        <div class="login-horizental">
                                                                            <button class="btn btn-sm btn-primary login-submit-cs" type="submit">Simpan</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <?= form_close(); ?>                                                   
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    <!-- stockprice, feed area end-->
    <!-- Static Table Start -->
    <div class="static-table-area mg-b-40">
        <div class="container">
            <div class="row">
            <div class="row">
                <div class="col-lg-12">
                    <?php 
                        if( $this->session->flashdata('sukses') ) {
                            echo '<div class="alert-wrap2 shadow-reset wrap-alert-b">';
                            echo    '<div class="alert alert-success">';
                            echo        '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
                            echo        "<strong>Berhasil! </strong>".$this->session->flashdata('sukses')."</div></div>";
                        }
                        if( $this->session->flashdata('gagal') ) {
                            echo '<div class="alert-wrap2 shadow-reset wrap-alert-b">';
                            echo    '<div class="alert alert-danger">';
                            echo        '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
                            echo        "<strong>Gagal! </strong>".$this->session->flashdata('gagal')."</div></div>";
                        }
                    ?>
                    <div class="sparkline10-list shadow-reset mg-t-30">
                        <div class="sparkline10-hd">
                            <div class="main-sparkline10-hd">
                                <h1>Daftar Pasien</h1>
                                <div class="sparkline10-outline-icon">
                                    <span class="sparkline10-collapse-link"><i class="fa fa-chevron-up"></i></span>
                                    <span><i class="fa fa-wrench"></i></span>
                                    <span class="sparkline10-collapse-close"><i class="fa fa-times"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="sparkline10-graph">
                            <div class="static-table-list">
                                <table class="table border-table">
                                    <thead>
                                        <tr>
                                            <th width="50px">#</th>
                                            <th width="100px">Kode Pasien</th>
                                            <th>Nama Pasien</th>
                                            <th width="200px">Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- <?php $x = 1; foreach ($gejala as $row) { ?>
                                            <tr>
                                                <td><?= $x++; ?></td>
                                                <td><?= $row['kode_gejala']; ?></td>
                                                <td><?= $row['nama_gejala']; ?></td>
                                                <td>
                                                    <?php include('edit.php'); ?>
                                                    
                                                    <?php include('delete.php'); ?>
                                                </td>
                                            </tr>
                                        <?php } ?> -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Static Table End -->                        

