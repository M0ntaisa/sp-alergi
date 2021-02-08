<button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#edit-<?= $row['id_alergi']; ?>">
    <i class="fa fa-edit"></i> Edit
</button>

<div id="edit-<?= $row['id_alergi']; ?>" class="modal modal-adminpro-general modal-zoomInDown fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-close-area modal-close-df">
                <a class="close" data-dismiss="modal" href="#" style="background-color:orange;"><i class="fa fa-close"></i></a>
            </div>
            <div class="modal-body">
                <div class="modal-login-form-inner">
                    <div class="row">
                        <div class="col-lg-12">
                                <div class="sparkline12-graph">
                                    <div class="basic-login-form-ad">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="all-form-element-inner">
                                                    <?= form_open(base_url('admin/alergi/edit_alergi')); ?>
                                                    <div class="form-group-inner">
                                                        <div class="row">
                                                            <div class="col-lg-4">
                                                                <label class="login2">Kode Alergi</label>
                                                            </div>
                                                            <div class="col-lg-8">
                                                                <input type="text" name="kode_alergi" class="form-control" value="<?= $row['kode_alergi'] ?>" readonly />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group-inner">
                                                        <div class="row">
                                                            <div class="col-lg-4">
                                                                <label class="login2">Alergi</label>
                                                            </div>
                                                            <div class="col-lg-8">
                                                                <textarea class="form-control" name="nama_alergi" id="nama_alergi" cols="30" rows="5"><?= $row['nama_alergi']; ?></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group-inner">
                                                        <div class="row">
                                                            <div class="col-lg-4">
                                                                <label class="login2">Keterangan Alergi</label>
                                                            </div>
                                                            <div class="col-lg-8">
                                                                <textarea class="form-control" name="ket" id="ket" cols="30" rows="10"><?= $row['ket']; ?></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group-inner">
                                                        <div class="row">
                                                            <div class="col-lg-4">
                                                                <label class="login2">Solusi Alergi</label>
                                                            </div>
                                                            <div class="col-lg-8">
                                                                <textarea class="form-control" name="solusi" id="solusi" cols="30" rows="10"><?= $row['solusi']; ?></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="login-btn-inner">
                                                        <div class="row">
                                                            <div class="col-lg-9"></div>
                                                            <div class="col-lg-3">
                                                                <div class="login-horizental">
                                                                    <button class="btn btn-sm btn-warning" type="submit">Simpan</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?= form_close(); ?>
                                                </div>
                                            </div>
                                        </div>
                                    <!-- </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Basic Form End-->
        </div>
    </div>
</div>