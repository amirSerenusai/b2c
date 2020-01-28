<!DOCTYPE html>
<html dir="ltr" lang="en-US">
<head>

    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="author" content="SemiColonWeb" />

    <!-- Stylesheets
    ============================================= -->
@component('medical.css')@endcomponent


<!-- Document Title
	============================================= -->
    <title>Online Medical Procedures | Serenus AI.</title>



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
@component('medical.new-header')@endcomponent
<!-- #header end -->

    <!-- page-title
    ============================================= -->
    <section id="page-title" class="nobg">

        <div class="container clearfix">
            <h1>Doctors</h1>
            <span>A Short Page Title Tagline</span>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Doctors</li>
            </ol>
        </div>

    </section>
{{--    END PAGE TITLE--}}

    <!-- Content
    ============================================= -->
    <section id="content" style="margin-bottom: 0px;">

        <div class="content-wrap">

            <div class="container clearfix">

                <div class="col_one_fourth">

                    <div class="team">
                        <div class="team-image grayscale">
                            <img src="{{asset('assets/images/doctor_images/drelidan.jpeg')}}" alt="" >
                        </div>
                        <div class="team-desc">
                            <div class="team-title">
                                <a href="#"><h4>Dr. John Doe</h4></a>
                                <a href="#"><span>Cardiologist</span></a>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="col_one_fourth">
                    <div class="team">
                        <div class="team-image grayscale">
                            <img src="{{asset('assets/images/doctor_images/dr_baniel.jpg')}}" alt="" >
                        </div>
                        <div class="team-desc">
                            <div class="team-title">
                                <a href="#"><h4>Dr. Bryan Mcguire</h4></a>
                                <a href="#"><span>Orthopedist</span></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col_one_fourth">
                    <div class="team">
                        <div class="team-image grayscale">
                            <img src="{{asset('assets/images/doctor_images/8202.jpg')}}" alt="" >
                        </div>
                        <div class="team-desc">
                            <div class="team-title">
                                <a href="#"><h4>Dr. Mary Jane</h4></a>
                                <a href="#"><span>Neurologist</span></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col_one_fourth col_last">
                    <div class="team">
                        <div class="team-image grayscale">
                            <img src="{{asset('assets/images/doctor_images/dr_shemesh.jpg')}}" alt="" >
                        </div>
                        <div class="team-desc">
                            <div class="team-title">
                                <a href="#"><h4>Dr. Silvia Bush</h4></a>
                                <a href="#"><span>Dentist</span></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="clear"></div>

                <div class="col_one_fourth">
                    <div class="team">
                        <div class="team-image grayscale">
                            <img src="{{asset('assets/images/doctor_images/dr9.jpeg')}}" alt="" >
                        </div>
                        <div class="team-desc">
                            <div class="team-title">
                                <a href="#"><h4>Dr. Hugh Baldwin</h4></a>
                                <a href="#"><span>Cardiologist</span></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col_one_fourth">
                    <div class="team">
                        <div class="team-image grayscale">
                            <img src="{{asset('assets/images/doctor_images/dr7.jpeg')}}" alt="" >
                        </div>
                        <div class="team-desc">
                            <div class="team-title">
                                <a href="#"><h4>Dr. Erika Todd</h4></a>
                                <a href="#"><span>Neurologist</span></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col_one_fourth">
                    <div class="team">
                        <div class="team-image grayscale">
                            <img src="{{asset('assets/images/doctor_images/steven.jpg')}}" alt="" >
                        </div>
                        <div class="team-desc">
                            <div class="team-title">
                                <a href="#"><h4>Dr. Steven</h4></a>
                                <a href="#"><span>Dentist</span></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col_one_fourth  col_last">
                    <div class="team">
                        <div class="team-image grayscale">
                            <img src="{{asset('assets/images/doctor_images/4444.png')}}" alt="" >
                        </div>
                        <div class="team-desc">
                            <div class="team-title">
                                <a href="#"><h4>Dr. Steven</h4></a>
                                <a href="#"><span>Dentist</span></a>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col_one_fourth  ">
                    <div class="team">
                        <div class="team-image grayscale ">
                            {{--								<img src="demos/medical/images/doctors/9.jpg" alt="Dr. John Doe">--}}
                            <img src="{{asset('assets/images/doctor_images/dr_michael_eldar.jpg')}}" alt="" >
                        </div>

                        <div class="team-desc  col_last">
                            <div class="team-title">
                                <a href="#"><h4>Dr. Steven</h4></a>
                                <a href="#"><span>Dentist</span></a>
                            </div>
                        </div>
                    </div>
                </div>



                <div class="col_one_fourth  col_last">
                    <div class="team">
                        <div class="team-image grayscale">
                            <img src="{{asset('assets/images/doctor_images/dr8.png')}}" alt="" >
                        </div>
                        <div class="team-desc">
                            <div class="team-title">
                                <a href="#"><h4>Dr. Alan Freeman</h4></a>
                                <a href="#"><span>Eye Specialist</span></a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="promo promo-flat promo-dark promo-full uppercase footer-stick">
                <div class="container clearfix">
                    <h3 style="letter-spacing: 2px;">Start Planning your New Dream Home with us</h3>
                    <span class="nott">We strive to provide Our Customers with Top Notch Support to make their Theme</span>
                    <a href="#" class="button button-large button-border button-rounded button-light button-white">Contact Us</a>
                </div>
            </div>

        </div>


        <div class="container clearfix">
            <div class="heading-block center nobottomborder">
                <h3>Meet our Team of Specialists<span>.</span></h3>
                <span>We make sure that your Life are in Good Hands.</span>
            </div>



</div>




    </section>
   <!-- #content end -->

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
    $('nav ul').removeClass('current');
    $('li:contains("Doctor")').addClass('current');
    function  goTo(link){
        location.href = link;
    }
</script>

</body>
</html>
