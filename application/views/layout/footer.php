<!-- footer -->
<footer class="footer-emp bg-dark py-5">
		<div class="container">
			<div class="row footer-top">
				<div class="col-lg-4 footer-grid pr-5">
					<h2 class="footer-title border-bottom text-uppercase mb-4 pb-3">About Us</h2>
					<div class="footer-text">
						
						<p>Curabitur non nulla sit amet nislinit tempus convallis quis ac lectus. lac inia eget consectetur sed, convallis at
							tellus. Nulla porttitor accumsana tincidunt.</p>

					</div>
				</div>
				<div class="col-lg-4 footer-grid my-lg-0 my-4">
					<h3 class="footer-title border-bottom text-uppercase mb-4 pb-3">Quick Links</h3>
					<ul class="links list-unstyled">
						<li>
							<a href="<?= base_url('home') ?>">Home</a>
						</li>
						<li class="my-2">
							<a href="<?= base_url('about') ?>">About Us</a>
						</li>
					</ul>
					
					
				</div>
				<div class="col-lg-4 footer-grid">
					<h3 class="footer-title border-bottom text-uppercase mb-4 pb-3">Contact Us</h3>
					<div class="contact-info">
						<ul class="list-unstyled">
							<li>
								<div class="row">
									<div class="col-1">
										<i class="fas fa-map-marker"></i>
									</div>
									<div class="col-11">
										<p>The company name
											<span>Lorem ipsum dolor,</span>New York,Morris Park. </p>
									</div>
								</div>
							</li>
							<li class="my-2">
								<div class="row">
									<div class="col-1">
										<i class="fas fa-phone"></i>
									</div>
									<div class="col-11">
										<p>1234567890</p>
									</div>
								</div>
							</li>
							<li>
								<div class="row">
									<div class="col-1">
										<i class="fas fa-envelope"></i>
									</div>
									<div class="col-11">
										<a href="mailto:info@example.com">mail@example.com</a>
									</div>
								</div>
							</li>
						</ul>

					</div>
					<ul class="footer-social mt-md-4 mt-3">
						<li class="mx-2">
							<a href="#">
								<span class="fab fa-facebook-f"></span>
							</a>
						</li>
						<li class="mx-2">
							<a href="#">
								<span class="fab fa-twitter"></span>
							</a>
						</li>
						<li class="mx-2">
							<a href="#">
								<span class="fab fa-google-plus-g"></span>
							</a>
						</li>
						<li class="mx-2">
							<a href="#">
								<span class="fab fa-linkedin-in"></span>
							</a>
						</li>
						<li class="mx-2">
							<a href="#">
								<span class="fas fa-rss"></span>
							</a>
						</li>
						<li class="mx-2">
							<a href="#">
								<span class="fab fa-vk"></span>
							</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</footer>
	<div class="copyright py-3">
		<p class="copy-right text-center ">&copy; 2018 Pervasive. All Rights Reserved | Design by
			<a href="http://w3layouts.com/"> W3layouts </a>
		</p>
	</div>
	<!-- //footer -->


<!-- js -->
    <script src="<?= base_url() ?>assets/templates/users/js/jquery-2.2.3.min.js"></script>
<!-- //js -->
<!-- stats -->
	<script src="<?= base_url() ?>assets/templates/users/js/jquery.waypoints.min.js"></script>
	<script src="<?= base_url() ?>assets/templates/users/js/jquery.countup.js"></script>
		<script>
			$('.counter').countUp();
		</script>
<!-- //stats -->
  <!-- testimonials  Responsiveslides -->
    <script src="<?= base_url() ?>assets/templates/users/js/responsiveslides.min.js"></script>
    <script>
        // You can also use"$(window).load(function() {"
        $(function () {
            // Slideshow 4
            $("#slider3").responsiveSlides({
                auto: true,
                pager: true,
                nav: false,
                speed: 500,
                namespace: "callbacks",
                before: function () {
                    $('.events').append("<li>before event fired.</li>");
                },
                after: function () {
                    $('.events').append("<li>after event fired.</li>");
                }
            });

        });
    </script>
    <!-- //testimonials  Responsiveslides -->
<!--pop-up-box -->
	<script src="<?= base_url() ?>assets/templates/users/js/jquery.magnific-popup.js"></script>
	<script>
		$(document).ready(function () {
			$('.popup-with-zoom-anim').magnificPopup({
				type: 'inline',
				fixedContentPos: false,
				fixedBgPos: true,
				overflowY: 'auto',
				closeBtnInside: true,
				preloader: false,
				midClick: true,
				removalDelay: 300,
				mainClass: 'my-mfp-zoom-in'
			});
		});
	</script>
	<!-- //pop-up-box -->

<!-- script for password match -->
    <script>
        window.onload = function () {
            document.getElementById("password1").onchange = validatePassword;
            document.getElementById("password2").onchange = validatePassword;
        }

        function validatePassword() {
            var pass2 = document.getElementById("password2").value;
            var pass1 = document.getElementById("password1").value;
            if (pass1 != pass2)
                document.getElementById("password2").setCustomValidity("Passwords Don't Match");
            else
                document.getElementById("password2").setCustomValidity('');
            //empty string means no validation error
        }
    </script>
    <!-- script for password match -->
    <!-- start-smooth-scrolling -->
    <script src="<?= base_url() ?>assets/templates/users/js/move-top.js"></script>
    <script src="<?= base_url() ?>assets/templates/users/js/easing.js"></script>
    <script>
        jQuery(document).ready(function ($) {
            $(".scroll").click(function (event) {
                event.preventDefault();

                $('html,body').animate({
                    scrollTop: $(this.hash).offset().top
                }, 1000);
            });
        });
    </script>
    <!-- //end-smooth-scrolling -->
    <!-- smooth-scrolling-of-move-up -->
    <script>
        $(document).ready(function () {
            /*
            var defaults = {
                containerID: 'toTop', // fading element id
                containerHoverID: 'toTopHover', // fading element hover id
                scrollSpeed: 1200,
                easingType: 'linear' 
            };
            */

            $().UItoTop({
                easingType: 'easeOutQuart'
            });

        });
    </script>
    <script src="<?= base_url() ?>assets/templates/users/js/SmoothScroll.min.js"></script>
    <!-- //smooth-scrolling-of-move-up -->
    <!-- Bootstrap core JavaScript
================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="<?= base_url() ?>assets/templates/users/js/bootstrap.js"></script>
</body>

</html>