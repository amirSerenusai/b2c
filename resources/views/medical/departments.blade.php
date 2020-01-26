
<html dir="ltr" lang="en-US">
<head>

    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="author" content="SemiColonWeb" />
    <meta name="api-base-url" content="{{ url('/') }}" />

    <!-- Stylesheets
    ============================================= -->
    <link href="http://fonts.googleapis.com/css?family=Lato:300,400,400i,700|Montserrat:400,700|Crete+Round:400i" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{asset('style.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{asset('css/swiper.css')}}" type="text/css" />

@component('medical.css')@endcomponent
    <!--[if lt IE 9]>
    <script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
    <![endif]-->

    <!-- Document Title
    ============================================= -->
    <title>Procedures - Medical | Canvas</title>

    <style>
        .device-md .accordion.accordion-bg .acc_content,
        .device-sm .accordion.accordion-bg .acc_content {
            padding: 10px 0 15px 0;
        }
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
                                <li><a href="#"><img src="{{asset('images/icons/flags/french.png')}}" alt="French"> FR</a></li>
                                <li><a href="#"><img src="{{asset('images/icons/flags/italian.png')}}" alt="Italian"> IT</a></li>
                                <li><a href="#"><img src="{{asset('images/icons/flags/german.png')}}" alt="German"> DE</a></li>
                            </ul>
                        </li>
                        <li><a href="/demo-medical.html#booking-appointment-form" data-offset="100" data-easing="easeInOutExpo" data-speed="1200" class="bgcolor" style="color:#FFF;">Book an Appointment</a></li>
                    </ul>
                </div><!-- .top-links end -->

            </div>

        </div>

    </div><!-- #top-bar end -->

    <!-- Header
    ============================================= -->
{{--@component('medical.header')@endcomponent--}}
@component('medical.new-header')@endcomponent


    <!-- Page Title
    ============================================= -->
    <section id="page-title" class="bgcolor page-title-dark background-mount" style="background-image: url(images/about/parallax.jpg) ;      background-size: cover; /* Resize the background image to cover the entire container */

 background-position: 0px -250px;
">

        <div class="container clearfix">
{{--            <h1>Departments blade php</h1>--}}
            <h1>Considering Ventilation Tubes Insertion ?</h1>
{{--            <span>A Short Page Title Tagline</span>--}}
            <span>ENHANCE YOUR KNOWLEDGE, BEFORE A RISKY MEDICAL PROCEDURE</span>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/medical')}}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Procedures</li>
            </ol>
            <br>


            </div>


    </section><!-- #page-title end -->
    <div class="container clearfix" style="margin-top : 60px">
        <div class="row ">

            <div class="col-lg-5 col-sm-9 offset-sm-2 offset-lg-0  " style="padding-left: 30px">
                <div class= "topmargin">
                    <h1>Start process.<br>Get online result now.</h1>
                </div>
                <div  style="margin-bottom: 10px">

                    <div class="widget clearfix">


                        <form id="widget-subscribe-form"  role="form" method="get" class="nobottommargin row clearfix">
{{--                            action="{{url('/appointment')}}"--}}
{{--                            <div class="col-lg-12  ">--}}
{{--                                <input type="email" id="widget-subscribe-form-email" name="widget-subscribe-form-email" class="sm-form-control required email" placeholder="Enter your Email to Subscribe to our Newsletter">--}}
{{--                            </div>--}}

{{--                                <br><br><br>--}}
{{--                                <button class="button button-rounded nomargin center btn-block template-btn" style="padding: 0 !important;" type="submit">Start process!</button>--}}
{{--                                <button  data-toggle="modal" data-target=".bs-example-modal-lg"   type="button" class="t400 capitalize button button-dark button-large button-circle " value="submit">Register Now</button>--}}
                            @component('components.new-start') @endcomponent
                            <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-body">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myModalLabel">Wev'e just sent you a link!</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor.</p>
                                                <p>Aenean lacinia bibendum nulla sed consectetur. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Donec sed odio dui. Donec ullamcorper nulla non metus auctor fringilla.</p>
                                                <p>Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.</p>
                                                <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor.</p>
                                                <p class="nobottommargin">Aenean lacinia bibendum nulla sed consectetur. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Donec sed odio dui. Donec ullamcorper nulla non metus auctor fringilla.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>


                    </div>
                    </div>
            </div>

            <div class="col-lg-7 col-md-10  offset-md-2 col-sm-12 offset-lg-0">

                <div style="position: relative; margin-bottom: -60px; height: 226px;" class="ohidden" data-height-xl="426" data-height-lg="567" data-height-md="470" data-height-xs="183">
{{--                    <img src="images/services/main-fbrowser.png" style="position: absolute; top: 0; left: 0;" data-animate="fadeInUp" data-delay="100" alt="Chrome" class="fadeInUp animated">--}}
{{--                    <img src="images/services/main-fmobile.png" style="position: absolute; top: 0; left: 0;" data-animate="fadeInUp" data-delay="400" alt="iPad" class="fadeInUp animated">--}}
                    <img src="{{asset('assets/images/welcome.png')}}"data-animate="fadeInUp" data-delay="400" alt="Chrome" class="fadeInUp animated">
                </div>

            </div>

        </div>
    </div>
    <!-- Content
    ============================================= -->
    <section id="content">

        <div class="content-wrap">

            <div class="container clearfix">

                <div class="tabs tabs-tb tabs-responsive clearfix" id="tab" data-accordion-style="accordion-bg">

                    <ul class="tab-nav clearfix">
                        <li><a href="#tabs-1"><i class="icon-medical-i-cardiology"></i> General Infdrmation</a></li>
                        <li><a href="#tabs-2"><i class="icon-medical-i-surgery"></i> Description of the Procedure</a></li>
                        <li><a href="#tabs-3"><i class="icon-medical-i-dental"></i>Recovery Time </a></li>
                        <li><a href="#tabs-4"><i class="icon-medical-ophthalmology"></i>  Alternative Care </a></li>
                    </ul>

                    <div class="tab-container">
                        <div class="tab-content clearfix" id="tabs-1">
                            <blockquote class="quote"><p> The insertion of ventilating tubes also known as tympanostomy tubes is a simple operation  and the most common procedure performed by ear,
                                nose, throat (ENT) specialists.
                                The main goal of the operation is to equalize the pressure between the middle ear and the surrounding,
                                thus preventing the formation of negative pressure and accumulation of fluids in the middle ear of patients
                                (particularly children) in which the Eustachian tube does not function well.
                                This fluid in the middle ear is a potential ground for recurrent infections as well as a cause for conductive hearing loss,
                                and as a result - speech and language delay.
                                The procedure includes small incision in the tympanic membrane (myringotomy) and the placement of pressure equalizer tubes in the tympanic membrane.
                                </p></blockquote >
                            <div class="row clearfix">
                                <div class="col-lg-4">
                                    <h4 class="leftmargin-sm"> Indication</h4>
                                    <ul class="price-table leftmargin-sm nobottommargin">
                                        <li>
                                            <span>Tummy Tuck</span>
                                            <div class="value">$130</div>
                                        </li>
                                        <li>
                                            <span>Description of the Procedure </span>
                                            <div class="value">$110</div>
                                        </li>
                                        <li>
                                            <span>Recovery Time </span>
                                            <div class="value">$90</div>
                                        </li>
                                        <li>
                                            <span>  Risks associated with the procedure  </span>
                                            <div class="value">$173</div>
                                        </li>
                                        <li>
                                            <span> Alternative Care</span>
                                            <div class="value">$124</div>
                                        </li>
                                    </ul>
                                    <a href="#" class="more-link leftmargin-sm bottommargin-sm">View Full Services→</a>
                                </div>
                                <div class="col-lg-4">
                                    <h4 class="leftmargin-sm">Therapists</h4>
                                    <ul class="price-table leftmargin-sm nobottommargin">
                                        <li>
                                            <span>Tummy Tuck</span>
                                            <div class="value">$120</div>
                                        </li>
                                        <li>
                                            <span>Liposuction</span>
                                            <div class="value">$210</div>
                                        </li>
                                        <li>
                                            <span>Heart Patient</span>
                                            <div class="value">$320</div>
                                        </li>
                                        <li>
                                            <span>Colonoscopy</span>
                                            <div class="value">$80</div>
                                        </li>
                                        <li>
                                            <span>Cardio</span>
                                            <div class="value">$42</div>
                                        </li>
                                    </ul>
                                    <a href="#" class="more-link leftmargin-sm bottommargin-sm">View Full Services→</a>
                                </div>
                                <div class="col-lg-4">
                                    <img src="{{ asset('demos/medical/images/section-bg.jpg') }}" alt="">
                                </div>
                            </div>
                        </div>

                        <div class="tab-content clearfix" id="tabs-2">
                            <blockquote class="quote"><p>
                                The insertion of ventilating tubes is a quick and a simple procedure. The main risks of the procedure are the risks associated with general anesthesia, but rarely recurrent infections can occur due to water penetration,  and  a perforation of the TM may persist after the extrusion of the tubes.
                                </p></blockquote>
                            <div class="row">
                                <div class="col-lg-6 bottommargin">

                                    <div class="team team-list clearfix">
                                        <div class="team-image">
                                            <img src="{{asset('demos/medical/images/doctors/1.jpg')}}" alt="John Doe">
                                        </div>
                                        <div class="team-desc">
                                            <div class="team-title"><h4>John Doe</h4><span>CEO</span></div>
                                            <div class="team-content">
                                                <p>Carbon emissions reductions giving, legitimize amplify non-partisan Aga Khan. Policy dialogue assessment expert free-speech cornerstone disruptor empower.</p>
                                            </div>
                                            <a href="#" class="social-icon si-rounded si-small si-facebook">
                                                <i class="icon-facebook"></i>
                                                <i class="icon-facebook"></i>
                                            </a>
                                            <a href="#" class="social-icon si-rounded si-small si-twitter">
                                                <i class="icon-twitter"></i>
                                                <i class="icon-twitter"></i>
                                            </a>
                                            <a href="#" class="social-icon si-rounded si-small si-gplus">
                                                <i class="icon-gplus"></i>
                                                <i class="icon-gplus"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6 bottommargin">
                                    <div class="team team-list clearfix">
                                        <div class="team-image">
                                            <img src="{{asset('demos/medical/images/doctors/4.jpg')}}" alt="Nix Maxwell" >
                                        </div>
                                        <div class="team-desc">
                                            <div class="team-title"><h4>Nix Maxwell</h4><span>Support</span></div>
                                            <div class="team-content">
                                                <p>Eradicate invest honesty human rights accessibility theory of social change. Diversity experience in the field compassion, inspire breakthroughs planned giving.</p>
                                            </div>
                                            <a href="#" class="social-icon si-rounded si-small si-forrst">
                                                <i class="icon-forrst"></i>
                                                <i class="icon-forrst"></i>
                                            </a>
                                            <a href="#" class="social-icon si-rounded si-small si-skype">
                                                <i class="icon-skype"></i>
                                                <i class="icon-skype"></i>
                                            </a>
                                            <a href="#" class="social-icon si-rounded si-small si-flickr">
                                                <i class="icon-flickr"></i>
                                                <i class="icon-flickr"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="tab-content clearfix" id="tabs-3">
                            <blockquote class="quote"><p>Usually the recovery time from the operation is a few hours depending on the influence of the anesthesia on the patient. Following the surgery, antibiotic ear drops are usually prescribed for a few days and the patient returns to full function.
                                    The tubes placed in the eardrums, in most cases, are gradually extruded into the external ear canals (usually in 6-12 months). In rare cases, should they have not fallen in two or three years - they should be removed in an additional short procedure. 
                                    It is important to prevent water from entering into the middle ears through the tubes by using ear plugs during baths, showers and swimming, in order to prevent infections, until the tubes fall out. 
                                </p></blockquote >
                            <div class="row clearfix">
                                <div class="col-lg-7">
                                    <div class="masonry-thumbs grid-4" data-big="4" data-lightbox="gallery">
                                        <a href="images/gallery/1.jpg" data-lightbox="gallery-item"><img class="image_fade"  src="{{asset('demos/medical/images/gallery/thumbs/1.jpg')}}" alt="Gallery Thumb 1"></a>
                                        <a href="images/gallery/2.jpg" data-lightbox="gallery-item"><img class="image_fade"  src="{{asset('demos/medical/images/gallery/thumbs/2.jpg')}}" alt="Gallery Thumb 2"></a>
                                        <a href="images/gallery/3.jpg" data-lightbox="gallery-item"><img class="image_fade" src="{{asset('demos/medical/images/gallery/thumbs/3.jpg')}}" alt="Gallery Thumb 3"></a>
                                        <a href="images/gallery/4.jpg" data-lightbox="gallery-item"><img class="image_fade" src="{{asset('demos/medical/images/gallery/thumbs/4.jpg')}}" alt="Gallery Thumb 4"></a>
                                        <a href="images/gallery/5.jpg" data-lightbox="gallery-item"><img class="image_fade"  src="{{asset('demos/medical/images/gallery/thumbs/5.jpg')}}" alt="Gallery Thumb 5"></a>
                                        <a href="images/gallery/6.jpg" data-lightbox="gallery-item"><img class="image_fade" src="{{asset('demos/medical/images/gallery/thumbs/6.jpg')}}" alt="Gallery Thumb 6"></a>
                                        <a href="images/gallery/7.jpg" data-lightbox="gallery-item"><img class="image_fade" src="{{asset('demos/medical/images/gallery/thumbs/7.jpg')}}" alt="Gallery Thumb 7"></a>
                                        <a href="images/gallery/9.jpg" data-lightbox="gallery-item"><img class="image_fade"  src="{{asset('demos/medical/images/gallery/thumbs/9.jpg')}}" alt="Gallery Thumb 9"></a>
                                        <a href="images/gallery/10.jpg" data-lightbox="gallery-item"><img class="image_fade"  src="{{asset('demos/medical/images/gallery/thumbs/10.jpg')}}" alt="Gallery Thumb 10"></a>
                                        <a href="images/gallery/11.jpg" data-lightbox="gallery-item"><img class="image_fade"  src="{{asset('demos/medical/images/gallery/thumbs/11.jpg')}}" alt="Gallery Thumb 11"></a>
                                        <a href="images/gallery/12.jpg" data-lightbox="gallery-item"><img class="image_fade"  src="{{asset('demos/medical/images/gallery/thumbs/12.jpg')}}" alt="Gallery Thumb 12"></a>
                                        <a href="images/gallery/13.jpg" data-lightbox="gallery-item"><img class="image_fade"  src="{{asset('demos/medical/images/gallery/thumbs/13.jpg')}}" alt="Gallery Thumb 13"></a>
                                        <a href="images/gallery/14.jpg" data-lightbox="gallery-item"><img class="image_fade"  src="{{asset('demos/medical/images/gallery/thumbs/14.jpg')}}" alt="Gallery Thumb 14"></a>
                                    </div>
                                </div>
                                <div class="col-lg-5 mt-5 mt-lg-0">
                                    <div class="feature-box fbox-plain">
                                        <div class="fbox-icon">
                                            <a href="#"><i class="icon-medical-i-cardiology"></i></a>
                                        </div>
                                        <h3>Intensive Care</h3>
                                        <p>Powerful Layout with Responsive functionality that can be adapted to any screen size. Resize browser to view.</p>
                                    </div>
                                    <div class="feature-box fbox-plain">
                                        <div class="fbox-icon">
                                            <a href="#"><i class="icon-medical-i-social-services"></i></a>
                                        </div>
                                        <h3>Family Planning</h3>
                                        <p>Looks beautiful &amp; ultra-sharp on Retina Screen Displays. Retina Icons, Fonts &amp; all others graphics are optimized.</p>
                                    </div>
                                    <div class="feature-box fbox-plain">
                                        <div class="fbox-icon">
                                            <a href="#"><i class="icon-medical-i-neurology"></i></a>
                                        </div>
                                        <h3>Expert Consultation</h3>
                                        <p>Canvas includes tons of optimized code that are completely customizable and deliver unmatched fast performance.</p>
                                    </div>
                                    <div class="feature-box fbox-plain">
                                        <div class="fbox-icon">
                                            <a href="#"><i class="icon-medical-i-denotal"></i></a>
                                        </div>
                                        <h3>Dental Sciences</h3>
                                        <p>Powerful Layout with Responsive functionality that can be adapted to any screen size. Resize browser to view.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-content clearfix" id="tabs-4">
                            <div class="row clearfix">
                                <div class="col-md-4">
                                    <div class="accordion clearfix">

                                        <div class="acctitle"><i class="acc-closed icon-medical-i-kidney color"></i><i class="acc-open icon-medical-kidney color"></i>Kidney Transplant</div>
                                        <div class="acc_content clearfix">Donec sed odio dui. Nulla vitae elit libero, a pharetra augue. Nullam id dolor id nibh ultricies vehicula ut id elit. Integer posuere erat a ante venenatis dapibus posuere velit aliquet.</div>

                                        <div class="acctitle"><i class="acc-closed icon-medical-i-respiratory color"></i><i class="acc-open icon-medical-respiratory color"></i>Pulmonary Treament</div>
                                        <div class="acc_content clearfix">Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Duis mollis, est non commodo luctus. Aenean lacinia bibendum nulla sed consectetur. Cras mattis consectetur purus sit amet fermentum.</div>

                                        <div class="acctitle"><i class="acc-closed icon-medical-i-ear-nose-throat color"></i><i class="acc-open icon-medical-ear-nose-throat color"></i>Ear, Nose &amp; Throat</div>
                                        <div class="acc_content clearfix">Nullam id dolor id nibh ultricies vehicula ut id elit. Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Duis mollis, est non commodo luctus. Aenean lacinia bibendum nulla sed consectetur.</div>

                                        <div class="acctitle"><i class="acc-closed icon-medical-i-cardiology color"></i><i class="acc-open icon-medical-cardiology color"></i>Cardiology Department</div>
                                        <div class="acc_content clearfix">Nullam id dolor id nibh ultricies vehicula ut id elit. Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Duis mollis, est non commodo luctus. Aenean lacinia bibendum nulla sed consectetur.</div>

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <h4 class="leftmargin-sm">Treatements</h4>
                                    <ul class="price-table leftmargin-sm nobottommargin">
                                        <li>
                                            <span>Tummy Tuck</span>
                                            <div class="value">$130</div>
                                        </li>
                                        <li>
                                            <span>Liposuction</span>
                                            <div class="value">$110</div>
                                        </li>
                                        <li>
                                            <span>Colonoscopy</span>
                                            <div class="value">$90</div>
                                        </li>
                                        <li>
                                            <span>Cardiac ablation</span>
                                            <div class="value">$173</div>
                                        </li>
                                        <li>
                                            <span>Dermatology</span>
                                            <div class="value">$124</div>
                                        </li>
                                    </ul>
                                    <a href="#" class="more-link leftmargin-sm bottommargin-sm">View Full Services→</a>
                                </div>
                                <div class="col-md-4">
                                    <h4 class="leftmargin-sm">Therapists</h4>
                                    <ul class="price-table leftmargin-sm nobottommargin">
                                        <li>
                                            <span>Tummy Tuck</span>
                                            <div class="value">$120</div>
                                        </li>
                                        <li>
                                            <span>Liposuction</span>
                                            <div class="value">$210</div>
                                        </li>
                                        <li>
                                            <span>Heart Patient</span>
                                            <div class="value">$320</div>
                                        </li>
                                        <li>
                                            <span>Colonoscopy</span>
                                            <div class="value">$80</div>
                                        </li>
                                        <li>
                                            <span>Cardio</span>
                                            <div class="value">$42</div>
                                        </li>
                                    </ul>
                                    <a href="#" class="more-link leftmargin-sm">View Full Services→</a>
                                </div>
                            </div>
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
<script src="{{asset('js/bootstrap.js')}}"></script>
<script src="{{asset('/js/jquery.js')}}"></script>
<script src="{{asset('/js/plugins.js')}}"></script>


<!-- Footer Scripts
============================================= -->
<script src="{{asset('/js/functions.js')}}"></script>

<script>
    $('nav ul').removeClass('current');
    $('li:contains("Procedures")').addClass('current')
    document.getElementById("widget-subscribe-form").addEventListener("click", function(event){
        event.preventDefault()
    });
    jQuery( '.tabs' ).on( 'tabsactivate', function( event, ui ) {
        var mThumbsAvailable = jQuery( ui.newPanel ).find('.masonry-thumbs');

        if( mThumbsAvailable.length > 0 ) {
            mThumbsAvailable.each( function(){
                var mThumbsGrid = jQuery(this);

                if( !mThumbsGrid.hasClass('tabs-enabled-masonry-thumbs') ) {
                    SEMICOLON.widget.masonryThumbs();
                    mThumbsGrid.addClass('tabs-enabled-masonry-thumbs');
                }
            });
        }
    });

</script>
<script src="{{asset('js/api_calls.js')}}"></script>
<script src="{{asset('js/custom_functions.js')}}"></script>
</body>
</html>
