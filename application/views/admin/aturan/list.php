<!-- stockprice, feed area start-->
<div class="login-form-area">
        <div class="container">
            <div class="row">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-md-6 col-sm-12 col-xs-12">
                            <div class="sparkline7-list stock-price-section shadow-reset nt-mg-b-30">
                                <div class="sparkline7-hd">
                                    <div class="main-spark7-hd">
                                        <h1>Tambah Data Aturan</h1>
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
                                                        <h4 class="modal-title">Tambah Data</h4>
                                                        <div class="modal-close-area modal-close-df">
                                                            <a class="close" data-dismiss="modal" href="#"><i class="fa fa-close"></i></a>
                                                        </div>
                                                    </div>
                                                    <div class="modal-body">
                                                        <?= form_open(base_url('admin/aturan/tambah_aturan')); ?>
                                                        <div class="form-group-inner">
                                                            <div class="row">
                                                                <div class="col-lg-4">
                                                                    <label class="login2">Alergi</label>
                                                                </div>
                                                                <div class="col-lg-8">
                                                                    <select class="form-control" name="id_alergi">
                                                                    <option value="" selected>Pilih Alergi ..</option>
                                                                    <?php foreach($alergi as $row){ ?>
                                                                        <option value="<?= $row['id_alergi']; ?>"><?= $row['kode_alergi']; ?> - <?= $row['nama_alergi']; ?>   </option>
                                                                    <?php } ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="form-group-inner">
                                                            <div class="row">
                                                                <div class="col-lg-4">
                                                                    <label class="login2">Gejala</label>
                                                                </div>
                                                                <div class="col-lg-8">
                                                                    <select class="form-control" name="id_gejala">
                                                                    <option value="" selected>Pilih Gejala..</option>
                                                                    <?php foreach($gejala as $row){ ?>
                                                                        <option value="<?= $row['id_gejala']; ?>"><?= $row['kode_gejala']; ?> - <?= $row['nama_gejala']; ?>   </option>
                                                                    <?php } ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group-inner">
                                                            <div class="row">
                                                                <div class="col-lg-4">
                                                                    <label class="login2">Nilai Kepercayaan</label>
                                                                </div>
                                                                <div class="col-lg-8">
                                                                    <input type="number" class="form-control" name="mb" min="0" max="1" step="0.01">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group-inner">
                                                            <div class="row">
                                                                <div class="col-lg-4">
                                                                    <label class="login2">Nilai Ketidakpercayaan</label>
                                                                </div>
                                                                <div class="col-lg-8">
                                                                    <input type="number" class="form-control" name="md" min="0" max="1" step="0.01">
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
    </div>
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
                                <h1>Daftar Gejala</h1>
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
                                            <th rowspan="2" style="padding-bottom:20px;">#</th>
                                            <th width="800px" rowspan="2" style="text-align:center;padding:25px;">Gejala</th>
                                            <th width="300px" rowspan="2" style="text-align:center;padding:25px;">Alergi</th>
                                            <th colspan="2">Nilai Aturan CF</th>
                                            <th width="300px" rowspan="2" style="text-align:center;padding:25px;" width="160px">Opsi</th>
                                        </tr>
                                        <tr>
                                            <th width="25px">MB</th>
                                            <th width="25px">MD</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $x = 1; foreach($aturan as $row) { ?>
                                            <?= form_open(base_url('admin/aturan/edit_nilai/'.$row['id_aturan'])); ?>
                                            <tr>
                                                <td><?= $x++; ?></td>
                                                <td><?= $row['nama_gejala']; ?></td>
                                                <td><?= $row['nama_alergi']; ?></td>
                                                <td>
                                                    <input type="number" name="nilai_mb" max="1" min="0" step="0.01" value="<?= $row['mb']; ?>">
                                                </td>
                                                <td>
                                                    <input type="number" name="nilai_md" max="1" min="0" step="0.01" value="<?= $row['md']; ?>">
                                                </td>
                                                <td>
                                                    <button type="submit" class="btn btn-warning btn-sm" name="edit">
                                                        <i class="fa fa-edit"></i> Edit
                                                    </button> 
                                                    <?php include('delete.php'); ?>
                                                </td>
                                            </tr>
                                            <?= form_close() ?>
                                        <?php } ?>
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


