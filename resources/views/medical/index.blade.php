<!DOCTYPE html>
<html dir="ltr" lang="en-US">
<head>

	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="author" content="SemiColonWeb" />

	<!-- Stylesheets
	============================================= -->
    @component('medical.css')@endcomponent
{{--	<link href="http://fonts.googleapis.com/css?family=Lato:300,400,400i,700|Montserrat:400,700|Crete+Round:400i" rel="stylesheet" type="text/css" />--}}
{{--	<link rel="stylesheet" href="css/bootstrap.css" type="text/css" />--}}
{{--	<link rel="stylesheet" href="style.css" type="text/css" />--}}
{{--	<link rel="stylesheet" href="css/swiper.css" type="text/css" />--}}

{{--	<!-- Medical Demo Specific Stylesheet -->--}}
{{--	<link rel="stylesheet" href="demos/medical/medical.css" type="text/css" />--}}
{{--	<!-- / -->--}}

{{--	<link rel="stylesheet" href="css/dark.css" type="text/css" />--}}
{{--	<link rel="stylesheet" href="css/font-icons.css" type="text/css" />--}}
{{--	<link rel="stylesheet" href="demos/medical/css/medical-icons.css" type="text/css" />--}}
{{--	<link rel="stylesheet" href="css/animate.css" type="text/css" />--}}
{{--	<link rel="stylesheet" href="css/magnific-popup.css" type="text/css" />--}}

{{--	<link rel="stylesheet" href="demos/medical/fonts.css" type="text/css" />--}}

{{--	<link rel="stylesheet" href="css/responsive.css" type="text/css" />--}}
{{--	<meta name="viewport" content="width=device-width, initial-scale=1" />--}}

{{--	<link rel="stylesheet" href="css/colors.php?color=DE6262" type="text/css" />--}}

	<!-- Document Title
	============================================= -->
	<title>Medical Demo | Canvas</title>

	<style>
		.form-control.error { border: 2px solid red; }
        #primary-menu.style-3 > ul > li.current > a, .bgcolor { background: linear-gradient(to right, #244cfd, #15e4fd);}
	</style>

</head>

<body class="stretched" data-loader-html="<div id='css3-spinner-svg-pulse-wrapper'><svg id='css3-spinner-svg-pulse' version='1.2' height='210' width='550' xmlns='http://www.w3.org/2000/svg' viewport='0 0 60 60' xmlns:xlink='http://www.w3.org/1999/xlink'><path id='css3-spinner-pulse' stroke='#DE6262' fill='none' stroke-width='2' stroke-linejoin='round' d='M0,90L250,90Q257,60 262,87T267,95 270,88 273,92t6,35 7,-60T290,127 297,107s2,-11 10,-10 1,1 8,-10T319,95c6,4 8,-6 10,-17s2,10 9,11h210' /></svg></div>">

	<!-- Document Wrapper
	============================================= -->
	<div id="wrapper" class="clearfix">

		<!-- Top Bar
		============================================= -->
		<div id="top-bar">

			<div class="container clearfix">

				<div class="col_half d-none d-md-block nobottommargin">

					<!-- Top Links
					============================================= -->
					<div class="top-links">
						<ul>
							<li><a href="#"><i class="icon-time"></i> Timings</a></li>
							<li><a href="#"><i class="icon-phone3"></i> +91-800-9876-221</a></li>
							<li><a href="#" class="nott"><i class="icon-envelope2"></i> medical@canvas.com</a></li>
						</ul>
					</div><!-- .top-links end -->

				</div>

				<div class="col_half col_last fright nobottommargin">

					<!-- Top Links
					============================================= -->
					<div class="top-links">
						<ul>
							<li><a href="#">EN</a>
								<ul>
									<li><a href="#"><img src="images/icons/flags/french.png" alt="French"> FR</a></li>
									<li><a href="#"><img src="images/icons/flags/italian.png" alt="Italian"> IT</a></li>
									<li><a href="#"><img src="images/icons/flags/german.png" alt="German"> DE</a></li>
								</ul>
							</li>
							<li><a href="#" data-scrollto="#booking-appointment-form" data-offset="100" data-easing="easeInOutExpo" data-speed="1200" class="bgcolor" style="color:#fff;">Book an Appointment</a></li>
						</ul>
					</div><!-- .top-links end -->

				</div>

			</div>

		</div><!-- #top-bar end -->

		<!-- Header
		============================================= -->
		<header id="header">

			<div id="header-wrap">

				<div class="container clearfix">

					<div id="primary-menu-trigger"><i class="icon-reorder"></i></div>

					<!-- Logo
					============================================= -->
					<div id="logo">
{{--						<a href="index.html" class="standard-logo"><img src="demos/medical/images/logo-medical.png" alt="Canvas Logo"></a>--}}
                        <a href="index.html" class="standard-logo" data-dark-logo="assets/images/serenus logo _left.svg"><img src="{{asset('assets/images/logo/logo2.png')}}"    alt="Canvas Logo"></a>
{{--						<a href="index.html" class="retina-logo"><img src="demos/medical/images/logo-medical@2x.png" alt="Canvas Logo"></a>--}}
                        <a href="index.html" class="retina-logo" data-dark-logo="assets/images/serenus logo _left.svg"><img src="{{asset('assets/images/logo/logo2.png')}}"    alt="Canvas Logo"></a>
					</div><!-- #logo end -->

					<!-- Primary Navigation
					============================================= -->
					<nav id="primary-menu" class="style-3">

						<ul>
							<li class="current"><a href="#"><div>Home</div></a></li>
							<li><a href="demos/medical/about-us.html"><div>About Us</div></a></li>
							<li><a href="{{url('departments')}}"><div>Procedures</div></a></li>
{{--                            demos/medical/departments.html--}}
							<li><a href="demos/medical/appointment.html"><div>Appointment</div></a></li>
							<li><a href="demos/medical/doctors.html"><div>Doctors</div></a>
								<ul>
									<li><a href="demos/medical/doctors-lists.html"><div>2 columns - List style</div></a></li>
									<li><a href="demos/medical/doctors-3.html"><div>3 columns</div></a></li>
									<li><a href="demos/medical/doctors.html"><div>4 columns</div></a></li>
								</ul>
							</li>
							<li><a href="demos/medical/blog.html"><div>Blog</div></a></li>
							<li><a href="demos/medical/contact.html"><div>Contact</div></a></li>
						</ul>

					</nav><!-- #primary-menu end -->

				</div>

			</div>

		</header><!-- #header end -->

		<!-- Slider
		============================================= -->
		<section id="slider" class="slider-element swiper_wrapper full-screen clearfix" data-loop="false" data-autoplay="15000">

			<div class="swiper-container swiper-parent">
				<div class="swiper-wrapper">
					<div class="swiper-slide" style="background-image: url('demos/medical/images/slider/1.jpg');">
						<div class="container clearfix">
							<div class="slider-caption slider-caption-right" style="max-width: 700px;">
								<h2 data-caption-animate="flipInX">Enhance your knowledge<span>.</span></h2>
                                <p class="d-none d-sm-block" data-caption-animate="flipInX" data-caption-delay="250"> before a risky medical procedure </p>
								<p class="d-none d-sm-block" data-caption-animate="flipInX" data-caption-delay="500">Our Team of Doctors are specialized in Various Disciplines to make sure you get the Best Treatment.</p>
                                @component('medical.pick-a-procedure')@endcomponent
							</div>
						</div>
					</div>
					<div class="swiper-slide" style="background-image: url('demos/medical/images/slider/2.jpg');">
						<div class="container clearfix">

							<div class="slider-caption">
								<h2 data-caption-animate="zoomIn">before <span>procedure</span>.</h2>
								<p class="d-none d-sm-block" data-caption-animate="zoomIn" data-caption-delay="500">Become updated with evidence based medical practices.</p>
                                <p class="d-none d-sm-block" data-caption-animate="zoomIn" data-caption-delay="1000"> Be informed of alternative conservative measures.</p>
                                <p class="d-none d-sm-block" data-caption-animate="zoomIn" data-caption-delay="1500">Developed by world renowned specialists.</p>
                            @component('medical.pick-a-procedure')@endcomponent
                            </div>

						</div>


					</div>


                </div>

			</div>

		</section><!-- #slider end -->

		<!-- Content
		============================================= -->
		<section id="content">

			<div class="content-wrap">

				<div class="container clearfix">

					<div class="col_one_third">
						<div class="feature-box fbox-plain">
							<div class="fbox-icon" data-animate="bounceIn">
								<a href="#"><i class="icon-medical-i-cardiology"></i></a>
							</div>
							<h3>Intensive Care</h3>
							<p>Powerful Layout with Responsive functionality that can be adapted to any screen size. Resize browser to view.</p>
						</div>
					</div>

					<div class="col_one_third">
						<div class="feature-box fbox-plain">
							<div class="fbox-icon" data-animate="bounceIn" data-delay="200">
								<a href="#"><i class="icon-medical-i-social-services"></i></a>
							</div>
							<h3>Family Planning</h3>
							<p>Looks beautiful &amp; ultra-sharp on Retina Screen Displays. Retina Icons, Fonts &amp; all others graphics are optimized.</p>
						</div>
					</div>

					<div class="col_one_third col_last">
						<div class="feature-box fbox-plain">
							<div class="fbox-icon" data-animate="bounceIn" data-delay="400">
								<a href="#"><i class="icon-medical-i-neurology"></i></a>
							</div>
							<h3>Expert Consultation</h3>
							<p>Canvas includes tons of optimized code that are completely customizable and deliver unmatched fast performance.</p>
						</div>
					</div>

					<div class="clear"></div>

					<div class="col_one_third">
						<div class="feature-box fbox-plain">
							<div class="fbox-icon" data-animate="bounceIn">
								<a href="#"><i class="icon-medical-i-dental"></i></a>
							</div>
							<h3>Dental Sciences</h3>
							<p>Powerful Layout with Responsive functionality that can be adapted to any screen size. Resize browser to view.</p>
						</div>
					</div>

					<div class="col_one_third">
						<div class="feature-box fbox-plain">
							<div class="fbox-icon" data-animate="bounceIn" data-delay="200">
								<a href="#"><i class="icon-medical-i-imaging-root-category"></i></a>
							</div>
							<h3>X-Ray Services</h3>
							<p>Looks beautiful &amp; ultra-sharp on Retina Screen Displays. Retina Icons, Fonts &amp; all others graphics are optimized.</p>
						</div>
					</div>

					<div class="col_one_third col_last">
						<div class="feature-box fbox-plain">
							<div class="fbox-icon" data-animate="bounceIn" data-delay="400">
								<a href="#"><i class="icon-medical-i-ambulance"></i></a>
							</div>
							<h3>24x7 Emergency</h3>
							<p>Canvas includes tons of optimized code that are completely customizable and deliver unmatched fast performance.</p>
						</div>
					</div>

				</div>

				<div class="section row nopadding common-height dark topmargin-sm">
					<div class="col-lg-5" data-height-xl="597" data-height-lg="614" data-height-md="400" data-height-sm="300" data-height-xs="200" style="background: url('demos/medical/images/section-bg.jpg') center center no-repeat; background-size: cover;">
						<div>&nbsp;</div>
					</div>
					<div id="booking-appointment-form" class="col-lg-7 nopadding">
						<div class="bgcolor contact-widget col-padding" data-loader="button">
							<h2>Book an Appointment.</h2>
							<div class="contact-form-result"></div>
							<form class="nobottommargin" id="template-medical-form" name="template-medical-form" action="demos/medical/include/appointment.php" method="post">
								<div class="col_two_third">
									<label for="template-medical-name">Name:</label>
									<input type="text" id="template-medical-name" name="template-medical-name" class="form-control not-dark required" value="">
								</div>
								<div class="col_one_third col_last">
									<label for="template-medical-phone">Phone:</label>
									<input type="text" id="template-medical-phone" name="template-medical-phone" class="form-control not-dark required" value="">
								</div>
								<div class="clear"></div>
								<div class="col_two_third">
									<label for="template-medical-email">Email Address:</label>
									<input type="email" id="template-medical-email" name="template-medical-email" class="form-control not-dark required" value="">
								</div>
								<div class="col_one_third col_last">
									<label for="template-medical-dob">Date of Birth:</label>
									<input type="text" id="template-medical-dob" name="template-medical-dob" class="form-control not-dark required" value="" placeholder="DD/MM/YYYY">
								</div>
								<div class="clear"></div>
								<div class="col_two_fifth nobottommargin">
									<div class="col_full">
										<label for="template-medical-appoint-date">Appointment Date:</label>
										<input type="text" id="template-medical-appoint-date" name="template-medical-appoint-date" class="form-control not-dark required" value="" placeholder="DD/MM/YYYY">
									</div>
									<div class="col_full nobottommargin">
										<label for="template-medical-second-booking">Booked with us Before?</label><br>
										<label class="rightmargin-sm">
											<input type="radio" id="template-medical-second-booking" name="template-medical-second-booking" value="yes">
											Yes
										</label>
										<label>
											<input type="radio" name="template-medical-second-booking" value="no" checked>
											No
										</label>
									</div>
								</div>
								<div class="col_three_fifth nobottommargin col_last">
									<label for="template-medical-message">Message:</label>
									<textarea id="template-medical-message" name="template-medical-message" class="form-control not-dark required" cols="30" rows="5"></textarea>
								</div>
								<div class="clear"></div>
								<div class="col_full hidden">
									<input type="text" name="template-medical-botcheck" value="" />
								</div>
								<div class="col_full topmargin-sm nobottommargin">
									<button class="button button-rounded button-white button-light nomargin" type="submit" value="submit">Confirm Booking</button>
								</div>
								<div class="clear"></div>
							</form>

						</div>
					</div>
				</div>

				<div class="container clearfix">

					<div class="col_three_fifth">
						<div class="accordion accordion-lg clearfix">

							<div class="acctitle"><i class="acc-closed icon-medical-i-kidney color"></i><i class="acc-open icon-medical-kidney color"></i>Kidney Transplant</div>
							<div class="acc_content clearfix">Donec sed odio dui. Nulla vitae elit libero, a pharetra augue. Nullam id dolor id nibh ultricies vehicula ut id elit. Integer posuere erat a ante venenatis dapibus posuere velit aliquet.</div>

							<div class="acctitle"><i class="acc-closed icon-medical-i-respiratory color"></i><i class="acc-open icon-medical-respiratory color"></i>Pulmonary Treament</div>
							<div class="acc_content clearfix">Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Duis mollis, est non commodo luctus. Aenean lacinia bibendum nulla sed consectetur. Cras mattis consectetur purus sit amet fermentum.</div>

							<div class="acctitle"><i class="acc-closed icon-medical-i-ophthalmology color"></i><i class="acc-open icon-medical-ophthalmology color"></i>Eye Care &amp; Lasik Surgery</div>
							<div class="acc_content clearfix">Nullam id dolor id nibh ultricies vehicula ut id elit. Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Duis mollis, est non commodo luctus. Aenean lacinia bibendum nulla sed consectetur.</div>

							<div class="acctitle"><i class="acc-closed icon-medical-i-ear-nose-throat color"></i><i class="acc-open icon-medical-ear-nose-throat color"></i>Ear, Nose &amp; Throat</div>
							<div class="acc_content clearfix">Nullam id dolor id nibh ultricies vehicula ut id elit. Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Duis mollis, est non commodo luctus. Aenean lacinia bibendum nulla sed consectetur.</div>

							<div class="acctitle"><i class="acc-closed icon-medical-i-cardiology color"></i><i class="acc-open icon-medical-cardiology color"></i>Cardiology Department</div>
							<div class="acc_content clearfix">Nullam id dolor id nibh ultricies vehicula ut id elit. Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Duis mollis, est non commodo luctus. Aenean lacinia bibendum nulla sed consectetur.</div>

						</div>
					</div>

					<div class="col_two_fifth col_last">
						<h4>Patient Testimonials<span>.</span></h4>
						<ul class="testimonials-grid grid-1 clearfix">
							<li class="noleftpadding notoppadding">
								<div class="testimonial">
									<div class="testi-image">
										<a href="#"><img src="images/testimonials/1.jpg" alt="Customer Testimonails"></a>
									</div>
									<div class="testi-content">
										<p>Incidunt deleniti blanditiis quas aperiam recusandae consequatur ullam quibusdam cum libero illo rerum repellendus!</p>
										<div class="testi-meta">
											John Doe
											<span>XYZ Inc.</span>
										</div>
									</div>
								</div>
							</li>
							<li class="noleftpadding nobottompadding">
								<div class="testimonial">
									<div class="testi-image">
										<a href="#"><img src="images/testimonials/2.jpg" alt="Customer Testimonails"></a>
									</div>
									<div class="testi-content">
										<p>Natus voluptatum enim quod necessitatibus quis expedita harum provident eos obcaecati id culpa corporis molestias.</p>
										<div class="testi-meta">
											Collis Ta'eed
											<span>Envato Inc.</span>
										</div>
									</div>
								</div>
							</li>
						</ul>
						<div class="clear"></div>
						<a href="#" class="button button-mini button-rounded norightmargin fright">More Patient Feedbacks...</a>
						<div class="clear"></div>
					</div>

				</div>

				<div class="section notopmargin">
					<div class="container clearfix">

						<div class="row">
							<div class="col-lg-3 col-md-6">
								<div class="feature-box fbox-outline fbox-dark fbox-effect clearfix">
									<div class="fbox-icon">
										<a href="#"><i class="icon-stack i-alt"></i></a>
									</div>
									<div class="counter counter-small"><span data-from="100" data-to="23331" data-refresh-interval="200" data-speed="2500"></span>+</div>
									<h5 class="nomargin color">Clients Served</h5>
									<div class="d-block d-md-block d-lg-none bottommargin"></div>
								</div>
							</div>

							<div class="col-lg-3 col-md-6">
								<div class="feature-box fbox-outline fbox-dark fbox-effect clearfix">
									<div class="fbox-icon">
										<a href="#"><i class="icon-tint i-alt"></i></a>
									</div>
									<div class="counter counter-small"><span data-from="100" data-to="56841" data-refresh-interval="250" data-speed="2000"></span>+</div>
									<h5 class="nomargin color">X-Rays Done</h5>
									<div class="d-block d-md-block d-lg-none bottommargin"></div>
								</div>
							</div>

							<div class="col-lg-3 col-md-6">
								<div class="feature-box fbox-outline fbox-dark fbox-effect clearfix">
									<div class="fbox-icon">
										<a href="#"><i class="icon-tint i-alt"></i></a>
									</div>
									<div class="counter counter-small"><span data-from="100" data-to="332" data-refresh-interval="50" data-speed="3000"></span>+</div>
									<h5 class="nomargin color">Worldwide Staff</h5>
									<div class="d-block d-md-none bottommargin"></div>
								</div>
							</div>

							<div class="col-lg-3 col-md-6">
								<div class="feature-box fbox-outline fbox-dark fbox-effect clearfix">
									<div class="fbox-icon">
										<a href="#"><i class="icon-text-width i-alt"></i></a>
									</div>
									<div class="counter counter-small"><span data-from="100" data-to="2213" data-refresh-interval="110" data-speed="3500"></span>+</div>
									<h5 class="nomargin color">Lives Saved</h5>
								</div>
							</div>
						</div>

					</div>
				</div>

				<div class="container clearfix">
					<div class="heading-block center nobottomborder">
						<h3>Meet our Team of Specialists<span>.</span></h3>
						<span>We make sure that your Life are in Good Hands.</span>
					</div>

					<div id="oc-team" class="owl-carousel team-carousel carousel-widget" data-margin="30" data-nav="true" data-pagi="true" data-items-xs="1" data-items-sm="2" data-items-lg="3" data-items-xl="4">

						<div class="team">
							<div class="team-image">
								<img src="demos/medical/images/doctors/1.jpg" alt="Dr. John Doe">
							</div>
							<div class="team-desc">
								<div class="team-title"><h4>Dr. John Doe</h4><span>Cardiologist</span></div>
							</div>
						</div>

						<div class="team">
							<div class="team-image">
								<img src="demos/medical/images/doctors/2.jpg" alt="Dr. John Doe">
							</div>
							<div class="team-desc">
								<div class="team-title"><h4>Dr. Bryan Mcguire</h4><span>Orthopedist</span></div>
							</div>
						</div>

						<div class="team">
							<div class="team-image">
								<img src="demos/medical/images/doctors/3.jpg" alt="Dr. John Doe">
							</div>
							<div class="team-desc">
								<div class="team-title"><h4>Dr. Mary Jane</h4><span>Neurologist</span></div>
							</div>
						</div>

						<div class="team">
							<div class="team-image">
								<img src="demos/medical/images/doctors/4.jpg" alt="Dr. John Doe">
							</div>
							<div class="team-desc">
								<div class="team-title"><h4>Dr. Silvia Bush</h4><span>Dentist</span></div>
							</div>
						</div>

						<div class="team">
							<div class="team-image">
								<img src="demos/medical/images/doctors/6.jpg" alt="Dr. John Doe">
							</div>
							<div class="team-desc">
								<div class="team-title"><h4>Dr. Hugh Baldwin</h4><span>Cardiologist</span></div>
							</div>
						</div>

						<div class="team">
							<div class="team-image">
								<img src="demos/medical/images/doctors/7.jpg" alt="Dr. John Doe">
							</div>
							<div class="team-desc">
								<div class="team-title"><h4>Dr. Erika Todd</h4><span>Neurologist</span></div>
							</div>
						</div>

						<div class="team">
							<div class="team-image">
								<img src="demos/medical/images/doctors/8.jpg" alt="Dr. John Doe">
							</div>
							<div class="team-desc">
								<div class="team-title"><h4>Dr. Randy Adams</h4><span>Dentist</span></div>
							</div>
						</div>

						<div class="team">
							<div class="team-image">
								<img src="demos/medical/images/doctors/9.jpg" alt="Dr. John Doe">
							</div>
							<div class="team-desc">
								<div class="team-title"><h4>Dr. Alan Freeman</h4><span>Eye Specialist</span></div>
							</div>
						</div>

					</div>

				</div>

			</div>

		</section><!-- #content end -->

		<!-- Footer
		============================================= -->
		@component('medical.footer')@endcomponent

	</div><!-- #wrapper end -->

	<!-- Go To Top
	============================================= -->
	<div id="gotoTop" class="icon-angle-up"></div>

	<!-- External JavaScripts
	============================================= -->
	<script src="js/jquery.js"></script>
	<script src="js/plugins.js"></script>

	<!-- Footer Scripts
	============================================= -->
	<script src="js/functions.js"></script>
    <script>

        function  goTo(link){
           location.href = link;
        }
    </script>
</body>
</html>