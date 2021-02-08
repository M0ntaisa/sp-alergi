<div class="inner-banner"></div>
</div>
	<!-- team -->
	<section class="team py-md-5 py-4">
        <div class="container py-lg-5">
            <div class="text-center wthree-title pb-sm-5 pb-3">
                <h3 class="tittle-w3ls pb-4">Konsultasi</h3>
            </div>
            <div class="inner_sec_info_wthree_agile mt-md-5 pt-3">
				<div class="row help_full">
					<div class="col-lg-3 banner_bottom_grid help">
						<!-- <img src="<?= base_url() ?>assets/templates/users/images/susu.jpg" alt=" " class="img-fluid"> -->
					</div>
					<div class="col-lg-6 banner_bottom_left">
                        <script type="text/javascript">
                            function checkAll(ele) {
                                var checkboxes = document.getElementsByTagName('input');
                                if (ele.checked) {
                                    for (var i = 0; i < checkboxes.length; i++) {
                                        if (checkboxes[i].type == 'checkbox' ) {
                                            checkboxes[i].checked = true;
                                        }
                                    }
                                } else {
                                    for (var i = 0; i < checkboxes.length; i++) {
                                        if (checkboxes[i].type == 'checkbox') {
                                            checkboxes[i].checked = false;
                                        }
                                    }
                                }
                            }
                        </script>
                        <h5 class="text-heading">Pilih Gejala Yang Diderita :</h5><br>
                        <?php 
                            if( $this->session->flashdata('gagal') ) {
                                echo '<div class="alert-wrap2 shadow-reset wrap-alert-b">';
                                echo    '<div class="alert alert-danger">';
                                echo        '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
                                echo        "<strong>Proses gagal! </strong>".$this->session->flashdata('gagal')."</div></div>";
                            }
                            if( $this->session->flashdata('warning') ) {
                                echo '<div class="alert-wrap2 shadow-reset wrap-alert-b">';
                                echo    '<div class="alert alert-warning">';
                                echo        '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
                                echo        "<strong>Warning! </strong>".$this->session->flashdata('warning')."</div></div>";
                            }
                        ?>
                        <div class="switch-wrap d-flex">
                            <input type="checkbox" style="height:20px;" onchange="checkAll(this)" name="chk[]">
                            <p style="font-size:15px;"> &nbsp; Pilih Semua Gejala</p>
                        </div> 
                        <?= form_open(base_url('konsultasi/proses')); ?>
                            <?php
                            //-- menampilkan daftar gejala
                            foreach ($gejala as $row) { ?>
                                <div class="switch-wrap d-flex">
                                    <input type="checkbox" style="height:20px;" id="foo" name="gejala[]" value="<?= $row['id_gejala'] ?>">
                                    <p style="font-size:15px;"> &nbsp; <?= $row['kode_gejala']; ?> - <?= $row['nama_gejala']; ?></p>
                                </div> 
                            <?php } ?>
                            <br>
                            <input class="btn btn-primary" type="submit" value="proses">
                        <?= form_close(); ?>
                    </div>
				</div>
			</div>
		</div>
	</section>
    <!-- //team -->