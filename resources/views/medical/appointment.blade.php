
<html dir="ltr" lang="en-US">
<head>

    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="author" content="SemiColonWeb" />
@component('medical.css') @endcomponent


    <title>Appointment - Medical | Canvas</title>

</head>

<body class="stretched" data-loader-html="<div id='css3-spinner-svg-pulse-wrapper'><svg id='css3-spinner-svg-pulse' version='1.2' height='210' width='550' xmlns='http://www.w3.org/2000/svg' viewport='0 0 60 60' xmlns:xlink='http://www.w3.org/1999/xlink'><path id='css3-spinner-pulse' stroke='#DE6262' fill='none' stroke-width='2' stroke-linejoin='round' d='M0,90L250,90Q257,60 262,87T267,95 270,88 273,92t6,35 7,-60T290,127 297,107s2,-11 10,-10 1,1 8,-10T319,95c6,4 8,-6 10,-17s2,10 9,11h210' /></svg></div>">


{{--Document Wrapper
============================================= --}}
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
                                <li><a href="#"><img src="../../images/icons/flags/french.png" alt="French"> FR</a></li>
                                <li><a href="#"><img src="../../images/icons/flags/italian.png" alt="Italian"> IT</a></li>
                                <li><a href="#"><img src="../../images/icons/flags/german.png" alt="German"> DE</a></li>
                            </ul>
                        </li>
                        <li><a href="#" data-scrollto="#booking-appointment-form" data-offset="160" data-easing="easeInOutExpo" data-speed="1200" class="bgcolor" style="color:#FFF;">Book an Appointment</a></li>
                    </ul>
                </div><!-- .top-links end -->

            </div>

        </div>

    </div><!-- #top-bar end -->


    @component('medical.header')@endcomponent

    <section id="page-title" class="page-title-parallax" style="background-image:  url('images/parallax/bg2.jpg'); background-position: bottom center; background-size: cover; padding: 80px 0;">

        <div class="container clearfix">
            <h1>Appointment</h1>
            <span>A Short Page Title Tagline</span>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Appointment</li>
            </ol>
        </div>

    </section><!-- #page-title end -->

    <!-- Content
    ============================================= -->
    <section id="content">

        <div class="content-wrap">

            <div class="container clearfix">

                <div class="heading-block center nobottomborder nobottommargin">
                    <h2 style="font-size: 4rem;
    letter-spacing: 2px;
    text-transform: uppercase;
    font-weight: 700;
    line-height: 1;
    margin-bottom: 0;">You earn your body.</h2>
{{--                    <span>Dynamically formulate error-free results before integrated results. Dramatically incubate integrated resources without cost effective "outside the.</span>--}}
                </div>

            </div>

            <div class="section nobottommargin parallax" style="background-image: {{asset('/medical/demos/images/appointment/bg.jpg')}} top center no-repeat / cover;"data-stellar-background-ratio="0.8">
                <div class="container clearfix">
                    <div class="row clearfix">
                        <div class="col-lg-5">
                            <div class="d-none d-lg-block" style="position: relative;" data-height-xl="413" >
                                <img  src="{{asset('demos/medical/images/appointment/doctor1.png')}}" alt="" style="position: absolute; bottom: -65px;">
                            </div>
                        </div>

                        <div id="booking-appointment-form" class="col-lg-7">
{{--                            <div id="medical-form-result" data-notify-type="success" data-notify-msg="<i class=icon-ok-sign></i> Message Sent Successfully!"></div>--}}
{{--                            <form class="nobottommargin" id="template-medical-form" name="template-medical-form" action="include/appointment.php" method="post">--}}
{{--                                <div class="col_two_third">--}}
{{--                                    <label for="template-medical-name">Name:</label>--}}
{{--                                    <input type="text" id="template-medical-name" name="template-medical-name" class="form-control not-dark required" value="">--}}
{{--                                </div>--}}
{{--                                <div class="col_one_third col_last">--}}
{{--                                    <label for="template-medical-phone">Phone:</label>--}}
{{--                                    <input type="text" id="template-medical-phone" name="template-medical-phone" class="form-control not-dark required" value="">--}}
{{--                                </div>--}}
{{--                                <div class="clear"></div>--}}
{{--                                <div class="col_two_third">--}}
{{--                                    <label for="template-medical-email">Email Address:</label>--}}
{{--                                    <input type="email" id="template-medical-email" name="template-medical-email" class="form-control not-dark required" value="">--}}
{{--                                </div>--}}
{{--                                <div class="col_one_third col_last">--}}
{{--                                    <label for="template-medical-dob">Date of Birth:</label>--}}
{{--                                    <input type="text" id="template-medical-dob" name="template-medical-dob" class="form-control not-dark required" value="" placeholder="DD/MM/YYYY">--}}
{{--                                </div>--}}
{{--                                <div class="clear"></div>--}}
{{--                                <div class="col_two_fifth nobottommargin">--}}
{{--                                    <div class="col_full">--}}
{{--                                        <label for="template-medical-appoint-date">Appointment Date:</label>--}}
{{--                                        <input type="text" id="template-medical-appoint-date" name="template-medical-appoint-date" class="form-control not-dark required" value="" placeholder="DD/MM/YYYY">--}}
{{--                                    </div>--}}
{{--                                    <div class="col_full nobottommargin">--}}
{{--                                        <label for="template-medical-second-booking">Booked with us Before?</label><br>--}}
{{--                                        <label class="rightmargin-sm">--}}
{{--                                            <input type="radio" id="template-medical-second-booking" name="template-medical-second-booking" value="yes">--}}
{{--                                            Yes--}}
{{--                                        </label>--}}
{{--                                        <label>--}}
{{--                                            <input type="radio" name="template-medical-second-booking" value="no" checked>--}}
{{--                                            No--}}
{{--                                        </label>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="col_three_fifth nobottommargin col_last">--}}
{{--                                    <label for="template-medical-message">Message:</label>--}}
{{--                                    <textarea id="template-medical-message" name="template-medical-message" class="form-control not-dark required" cols="30" rows="5"></textarea>--}}
{{--                                </div>--}}
{{--                                <div class="clear"></div>--}}
{{--                                <div class="col_full hidden">--}}
{{--                                    <input type="text" name="template-medical-botcheck" value="" />--}}
{{--                                </div>--}}
{{--                                <div class="col_full topmargin-sm nobottommargin">--}}
{{--                                    <button class="button button-rounded nomargin fright" type="submit" value="submit">Confirm Booking</button>--}}
{{--                                </div>--}}
{{--                                <div class="clear"></div>--}}
{{--                            </form>--}}
                            <div class="slider-caption slider-caption-center">
                            {{--style="top: 356px;--}}
                                <div class="d-flex justify-content-center align-items-center divcenter categories-lists mt-4">
                                    <div class="d-flex t600 ml-2 mb-0 p-2 h5 text-dark center justify-content-center align-items-center" style="background: url('demos/gym/images/brush.png')no-repeat center center / cover; width: 180px; height: 50px"><span class="align-self-center">$19.99/m</span></div>
                                    <a href="#" class="button button-rounded button-large nott ml-4 align-self-center">Reserve Now</a>
                                </div>
                                <div class="d-md-flex divcenter d-none categories-lists mt-5" style="width: 60%;">
                                    <div class="mr-auto">
                                        <span class="list-group-item h6 t300 py-2 px-1 nobg border-0"><i class="icon-line-plus mr-2"></i>No Monthly Commitment</span>
                                        <span class="list-group-item h6 t300 py-2 px-1 nobg border-0"><i class="icon-line-plus mr-2"></i>Locker Facility</span>
                                        <span class="list-group-item h6 t300 py-2 px-1 nobg border-0"><i class="icon-line-plus mr-2"></i>1 Day Free Pass</span>
                                        <span class="list-group-item h6 t300 py-2 px-1 nobg border-0"><i class="icon-line-plus mr-2"></i>Sauna &amp; Steam Available</span>
                                    </div>
                                    <div class="">
                                        <span class="list-group-item h6 t300 py-2 px-1 nobg border-0"><i class="icon-line-plus mr-2"></i>1 User Valid</span>
                                        <span class="list-group-item h6 t300 py-2 px-1 nobg border-0"><i class="icon-line-plus mr-2"></i>Shower Room</span>
                                        <span class="list-group-item h6 t300 py-2 px-1 nobg border-0"><i class="icon-line-plus mr-2"></i>Free WiFi Access</span>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-center align-items-center divcenter categories-lists mt-4">
                                    <div class="d-flex t600 ml-2 mb-0 p-2 h5 text-dark center justify-content-center align-items-center" style="background: url('demos/gym/images/brush.png')no-repeat center center / cover; width: 180px; height: 50px"><span class="align-self-center">$19.99/m</span></div>
                                    <a href="#" class="button button-rounded button-large nott ml-4 align-self-center">Reserve Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="section nomargin">
                <div class="container clearfix">
                    <div class="heading-block center nobottomborder bottommargin-lg">
                        <div> @component('components.paypal')
                            @endcomponent</div>
                        <h3>Questions Before Booking</h3>
                        <span>Dynamically formulate error-free results before integrated results. Dramatically incubate integrated resources without cost effective "outside the.</span>
                    </div>
                    <div id="faqs" class="faqs row">
                        <div class="col-lg-6">

                            <h4><strong class="color">Q.</strong> How do I become an author?</h4>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Assumenda, dolorum, vero ipsum molestiae minima odio quo voluptate illum excepturi quam cum voluptates doloribus quae nisi tempore necessitatibus dolores ducimus enim libero eaque explicabo suscipit animi at quaerat aliquid ex expedita perspiciatis? Saepe, aperiam, nam unde quas beatae vero vitae nulla.</p>

                            <div class="line line-sm"></div>

                            <h4><strong class="color">Q.</strong> Helpful Resources for Authors</h4>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Explicabo, placeat, architecto rem dolorem dignissimos repellat veritatis in et eos doloribus magnam aliquam ipsa alias assumenda officiis quasi sapiente suscipit veniam odio voluptatum. Enim at asperiores quod velit minima officia accusamus cumque eligendi consequuntur fuga? Maiores, quasi, voluptates, exercitationem fuga voluptatibus a repudiandae expedita omnis molestiae alias repellat perferendis dolores dolor.</p>

                            <div class="line line-sm"></div>

                            <h4><strong class="color">Q.</strong> How much money can I make?</h4>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Possimus, fugiat iste nisi tempore nesciunt nemo fuga? Nesciunt, delectus laboriosam nisi repudiandae nam fuga saepe animi recusandae. Asperiores, provident, esse, doloremque, adipisci eaque alias dolore molestias assumenda quasi saepe nisi ab illo ex nesciunt nobis laboriosam iusto quia nulla ad voluptatibus iste beatae voluptas corrupti facilis accusamus recusandae sequi debitis reprehenderit quibusdam. Facilis eligendi a exercitationem nisi et placeat excepturi velit!</p>
                        </div>

                        <div class="col-lg-6">

                            <h4><strong class="color">Q.</strong> What Images, Videos, Code or Music Can I Use in my Items?</h4>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad odio ab quis architecto recusandae doloremque incidunt! Eius, quidem, pariatur necessitatibus commodi aliquid deleniti repudiandae accusantium nemo voluptate ullam natus illum magnam alias nobis doloremque delectus ipsa dicta repellat maxime dignissimos eveniet quae debitis ratione assumenda tempore officiis fugiat dolor. Saepe iusto praesentium ullam aliquam impedit.</p>

                            <div class="line line-sm"></div>

                            <h4><strong class="color">Q.</strong> Can I use trademarked names in my items?</h4>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eveniet, nisi, laborum autem reprehenderit excepturi harum ipsum quod sit. Inventore et sunt nemo natus labore voluptate omnis reprehenderit culpa. Minus vitae molestiae totam ut a accusamus at fugiat nemo debitis delectus? Consectetur, deleniti, cupiditate ad doloribus numquam minus illum fugit laborum a voluptatum nulla at autem ab beatae odio dolorem assumenda magni laudantium saepe recusandae doloremque illo nesciunt aut quos debitis neque reiciendis veritatis iusto eos aliquid voluptatem pariatur eveniet velit?</p>

                            <div class="line line-sm"></div>

                            <h4><strong class="color">Q.</strong> How do I pay for items on the Marketplaces?</h4>
                            <p class="nobottommargin">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quo iusto aliquam voluptatem? Reiciendis, beatae, ipsam delectus voluptas ea error voluptates labore corporis ad tenetur sunt temporibus aperiam sit quis quasi tempora enim quo numquam provident ullam velit cumque similique veritatis quidem aliquam voluptatibus atque fugiat recusandae accusamus praesentium aut ipsa.</p>

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

    </section><!-- #content end -->

    <!-- Footer
    ============================================= -->
    <footer id="footer" style="background-color: #F5F5F5; border-top: 2px solid rgba(0,0,0,0.06);">

        <div class="container" style="border-bottom: 1px solid rgba(0,0,0,0.06);">

            <!-- Footer Widgets
            ============================================= -->
            <div class="footer-widgets-wrap clearfix">

                <div class="col_two_third">

                    <div class="widget clearfix">

                        <div class="widget-subscribe-form-result"></div>
                        <form id="widget-subscribe-form" action="../../include/subscribe.php" role="form" method="post" class="nobottommargin row clearfix">
                            <div class="col-lg-9">
                                <input type="email" id="widget-subscribe-form-email" name="widget-subscribe-form-email" class="sm-form-control required email" placeholder="Enter your Email to Subscribe to our Newsletter">
                            </div>
                            <div class="col-lg-3">
                                <button class="button button-rounded nomargin center btn-block" type="submit">Subscribe</button>
                            </div>
                        </form>

                        <div class="line line-sm"></div>

                        <div class="clear-bottommargin-sm clearfix">
                            <div class="row">
                                <div class="col-lg-3 col-6 bottommargin-sm widget_links">
                                    <ul>
                                        <li><a href="#">Home</a></li>
                                        <li><a href="#">About</a></li>
                                        <li><a href="#">FAQs</a></li>
                                        <li><a href="#">Support</a></li>
                                        <li><a href="#">Contact</a></li>
                                    </ul>
                                </div>

                                <div class="col-lg-3 col-6 bottommargin-sm widget_links">
                                    <ul>
                                        <li><a href="#">Shop</a></li>
                                        <li><a href="#">Portfolio</a></li>
                                        <li><a href="#">Blog</a></li>
                                        <li><a href="#">Events</a></li>
                                        <li><a href="#">Forums</a></li>
                                    </ul>
                                </div>

                                <div class="col-lg-3 col-6 bottommargin-sm widget_links">
                                    <ul>
                                        <li><a href="#">Corporate</a></li>
                                        <li><a href="#">Agency</a></li>
                                        <li><a href="#">eCommerce</a></li>
                                        <li><a href="#">Personal</a></li>
                                        <li><a href="#">One Page</a></li>
                                    </ul>
                                </div>

                                <div class="col-lg-3 col-6 bottommargin-sm widget_links">
                                    <ul>
                                        <li><a href="#">Restaurant</a></li>
                                        <li><a href="#">Wedding</a></li>
                                        <li><a href="#">App Showcase</a></li>
                                        <li><a href="#">Magazine</a></li>
                                        <li><a href="#">Landing Page</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

                <div class="col_one_third col_last">

                    <div class="widget clear-bottommargin-sm clearfix">

                        <div class="row">

                            <div class="col-lg-12 bottommargin-sm">
                                <div class="footer-big-contacts">
                                    <span>Call Us:</span>
                                    (91) 22 55412474
                                </div>
                            </div>

                            <div class="col-lg-12 bottommargin-sm">
                                <div class="footer-big-contacts">
                                    <span>Send an Email:</span>
                                    info@canvas.com
                                </div>
                            </div>

                        </div>

                    </div>

                    <div class="widget subscribe-widget clearfix">
                        <div class="row">

                            <div class="col-lg-6 clearfix bottommargin-sm">
                                <a href="#" class="social-icon si-dark si-colored si-facebook nobottommargin" style="margin-right: 10px;">
                                    <i class="icon-facebook"></i>
                                    <i class="icon-facebook"></i>
                                </a>
                                <a href="#"><small style="display: block; margin-top: 3px;"><strong>Like us</strong><br>on Facebook</small></a>
                            </div>
                            <div class="col-lg-6 clearfix">
                                <a href="#" class="social-icon si-dark si-colored si-rss nobottommargin" style="margin-right: 10px;">
                                    <i class="icon-rss"></i>
                                    <i class="icon-rss"></i>
                                </a>
                                <a href="#"><small style="display: block; margin-top: 3px;"><strong>Subscribe</strong><br>to RSS Feeds</small></a>
                            </div>

                        </div>
                    </div>

                </div>

            </div><!-- .footer-widgets-wrap end -->

        </div>

        <!-- Copyrights
        ============================================= -->
        <div id="copyrights" class="nobg">

            <div class="container clearfix">

                <div class="col_half">
                    Copyrights &copy; 2016 All Rights Reserved by Canvas Inc.<br>
                    <div class="copyright-links"><a href="#">Terms of Use</a> / <a href="#">Privacy Policy</a></div>
                </div>

                <div class="col_half col_last tright">
                    <div class="copyrights-menu copyright-links clearfix">
                        <a href="#">Home</a>/<a href="#">About Us</a>/<a href="#">Team</a>/<a href="#">Clients</a>/<a href="#">FAQs</a>/<a href="#">Contact</a>
                    </div>
                </div>

            </div>

        </div><!-- #copyrights end -->

    </footer><!-- #footer end -->

</div><!-- #wrapper end -->

<!-- Go To Top
============================================= -->
<div id="gotoTop" class="icon-angle-up"></div>

@component('medical.js') @endcomponent

<script>

    $("#template-medical-form").validate({
        submitHandler: function(form) {
            var formButton = $(form).find('button'),
                formButtonText = formButton.html();

            formButton.prop('disabled', true).html('<i class="icon-line-loader icon-spin norightmargin"></i>');
            $(form).ajaxSubmit({
                target: '#medical-form-result',
                success: function() {
                    formButton.prop('disabled', false).html(formButtonText);
                    $(form).find('.form-control').val('');
                    $('#medical-form-result').attr('data-notify-msg', $('#medical-form-result').html()).html('');
                    SEMICOLON.widget.notifications($('#medical-form-result'));
                }
            });
        }
    });

</script>

</body>
</html>
