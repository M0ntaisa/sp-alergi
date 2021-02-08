

<div class="inner-banner"></div>
</div>
	<!-- team -->
	<section class="team py-md-5 py-4">
        <div class="container py-lg-5">
		<h3 class="text-center tittle-w3ls pb-4">Hasil Konsultasi</h3>
			<div class="row">
				<div class="col-lg-3 banner_bottom_grid help">
				</div>
					<div class="col-lg-9 banner_bottom_grid help">
						<div class="wthree-title pb-sm-5 pb-3">
							<section class="sample-text-area">
								<div class="container">
									<?php $this->Konsultasi_model->prosesCF(); ?>
									<hr>
									<h2>HASIL</h2>
									<b>Nilai tertinggi dari perhitungan metode Certainty Factor adalah <strong><?= $rank_penyakit[0]['penyakit']; ?></strong>, dengan nilai = <strong><?= $rank_penyakit[0]['nilai']; ?></strong></b>
									<br>
									<p><?= $rank_penyakit[0]['ket']; ?></p>
									<p><?= $rank_penyakit[0]['solusi']; ?></p>
									<hr><br><br>
									<a href="<?= base_url('konsultasi') ?>" class="btn btn-warning text-uppercase">Kembali</a>
									<a href="<?= base_url('konsultasi/cetak/') ?>?id=<?= $this->session->userdata('id_user') ?>" class="btn btn-success text-uppercase" target="_blank">Cetak Hasil</a>
								</div>
							</section>
						</div>
					</div>
				</div>
			</div>
	</section>
	<!-- //team -->

			