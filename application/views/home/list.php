
        <div class="container">
            <!-- banner-text -->
            <div class="banner-text">
                <div class="slider-info">
                    <h3>SISTEM PAKAR DIAGNOSA ALERGI PADA BALITA</h3>
                    <!-- <p class="mt-3">Donec mi nulla, auctor nec sem a, ornare auctor mi. Sed mi tortor, commodo a felis in, fringilla tincidunt nulla. Vestibulum volutpat non eros ut vulpuuctor nec sem a, ornare auctor mi sed mi tortor.</p> -->
                    <?php if ($this->session->userdata('role_id') == "2") { ?>
                        <a class="btn btn-primary mt-lg-5 mt-3 agile-link-bnr" href="<?= base_url('konsultasi') ?>" role="button">Konsultasi</a>
                    <?php } else { ?>
                        <a class="btn btn-primary mt-lg-5 mt-3 agile-link-bnr" href="<?= base_url('auth/register') ?>" role="button">Registrasi</a>
                    <?php } ?>
                    
                </div>
            </div>
        </div>
    </div>
	 <!-- //banner-text -->