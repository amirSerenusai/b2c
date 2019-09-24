
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <title>Colorlib | Free Bootstrap Website Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />

    <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" media="screen">

{{--    <link href="{{asset('assets/css/template.css')}}" rel="stylesheet" media="screen">--}}
    <script type="e61d56bd17d79316e759fdbd-text/javascript">if ( top !== self ) top.location.replace( self.location.href );// Hey, don't iframe my iframe!</script>

    <link href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700,800,300" rel='stylesheet' type='text/css'>
    <link rel="shortcut icon" href="{{asset('assets/images/logo/favicon.png')}}" type="image/x-icon">

    <link rel="stylesheet" href="{{asset('assets/css/animate-3.7.0.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/font-awesome-4.7.0.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap-4.1.3.min.css')}}">

    <link rel="stylesheet" href="{{asset('assets/css/owl-carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/jquery.datetimepicker.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/linearicons.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    <!--[if lt IE 9]>
    <script>/*@cc_on'abbr article aside audio canvas details figcaption figure footer header hgroup mark meter nav output progress section summary subline time video'.replace(/\w+/g,function(n){document.createElement(n)})@*/</script>
    <![endif]-->
</head>
<body   @if (Request::path() == 'procedures')  background="assets/images/watercolor-939784_960_720.jpg" @endif style="background-size: 100%;">

<div class="preloader">
    <div class="spinner"></div>
</div>


<header class="header-area">
    <div class="header-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 d-md-flex">
                    <h6 class="mr-3"><span class="mr-2"><i class="fa fa-mobile"></i></span> call us now! +1 305 708 2563</h6>
                    <h6 class="mr-3"><span class="mr-2"><i class="fa fa-envelope-o"></i></span> <a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="422f27262b21232e02273a232f322e276c212d2f">[email&#160;protected]</a></h6>
                    <h6><span class="mr-2"><i class="fa fa-map-marker"></i></span> Find our Location</h6>
                </div>
                <div class="col-lg-3">
                    <div class="social-links">
                        <ul>
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                            <li><a href="#"><i class="fa fa-vimeo"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="header" id="home">
        <div class="container">
            <div class="row align-items-center justify-content-between d-flex">
                <div id="logo">
                    <a href="index.html"><img src="{{asset('assets/images/logo/logo.png')}}" alt="" title="" /></a>
                </div>
                <nav id="nav-menu-container">
                    <ul class="nav-menu">
                        <li class="menu-active"><a href="index.html">Home</a></li>
                        <li><a href="departments.html">departments</a></li>
                        <li><a href="doctors.html">doctors</a></li>
                        <li class="menu-has-children"><a href="">Pages</a>
                            <ul>
                                <li><a href="about.html">about us</a></li>
                                <li><a href="elements.html">elements</a></li>
                            </ul>
                        </li>
                        <li class="menu-has-children"><a href="">blog</a>
                            <ul>
                                <li><a href="blog-home.html">blog home</a></li>
                                <li><a href="blog-details.html">blog details</a></li>
                            </ul>
                        </li>
                        <li><a href="contact.html">Contact</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</header>
@yield('content')
@if (Request::path() != 'procedures')
<section class="specialist-area section-padding" style="background-color: rgba(0,0,0,0)">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3">
                <div class="section-top text-center">
                    <h2>Our specialish</h2>
                    <p>Green above he cattle god saw day multiply under fill in the cattle fowl a all, living, tree word link available in the service for subdue fruit.</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 col-sm-6">
                <div class="single-doctor mb-4 mb-lg-0">
                    <div class="doctor-img">
                        <img src="{{asset('assets/images/doctor1.jpg')}}" alt="" class="img-fluid">
                    </div>
                    <div class="content-area">
                        <div class="doctor-name text-center">
                            <h3>ethel davis</h3>
                            <h6>sr. faculty data science</h6>
                        </div>
                        <div class="doctor-text text-center">
                            <p>If you are looking at blank cassettes on the web, you may be very confused at the.</p>
                            <ul class="doctor-icon">
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                <li><a href="#"><i class="fa fa-pinterest"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="single-doctor mb-4 mb-lg-0">
                    <div class="doctor-img">
                        <img src="{{asset('assets/images/doctor2.jpg')}}" alt="" class="img-fluid">
                    </div>
                    <div class="content-area">
                        <div class="doctor-name text-center">
                            <h3>dand mories</h3>
                            <h6>sr. faculty plastic surgery</h6>
                        </div>
                        <div class="doctor-text text-center">
                            <p>If you are looking at blank cassettes on the web, you may be very confused at the.</p>
                            <ul class="doctor-icon">
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                <li><a href="#"><i class="fa fa-pinterest"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="single-doctor mb-4 mb-sm-0">
                    <div class="doctor-img">
                        <img src="{{asset('assets/images/doctor3.jpg')}}" alt="" class="img-fluid">
                    </div>
                    <div class="content-area">
                        <div class="doctor-name text-center">
                            <h3>align board</h3>
                            <h6>sr. faculty data science</h6>
                        </div>
                        <div class="doctor-text text-center">
                            <p>If you are looking at blank cassettes on the web, you may be very confused at the.</p>
                            <ul class="doctor-icon">
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                <li><a href="#"><i class="fa fa-pinterest"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="single-doctor">
                    <div class="doctor-img">
                        <img src="{{asset('assets/images/doctor4.jpg')}}" alt="" class="img-fluid">
                    </div>
                    <div class="content-area">
                        <div class="doctor-name text-center">
                            <h3>jeson limit</h3>
                            <h6>sr. faculty plastic surgery</h6>
                        </div>
                        <div class="doctor-text text-center">
                            <p>If you are looking at blank cassettes on the web, you may be very confused at the.</p>
                            <ul class="doctor-icon">
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                <li><a href="#"><i class="fa fa-pinterest"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endif

<section class="hotline-area text-center section-padding" style="background-color: rgba(0,0,0,0)">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2>Emergency hotline</h2>
                <span>(+01) – 256 567 550</span>
                <p class="pt-3">We provide 24/7 customer support. Please feel free to contact us <br>for emergency case.</p>
            </div>
        </div>
    </div>
</section>


<section class="news-area section-padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3">
                <div class="section-top text-center">
                    <h2>Recent medical news</h2>
                    <p>Green above he cattle god saw day multiply under fill in the cattle fowl a all, living, tree word link available in the service for subdue fruit.</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="single-news">
                    <div class="news-img">
                        <img src="{{asset('assets/images/news1.jpg')}}" alt="" class="img-fluid">
                    </div>
                    <div class="news-text">
                        <div class="news-date">
                            22 July 2018
                        </div>
                        <h3><a href="blog-details.html">chip to model coeliac disease</a></h3>
                        <p>Elementum libero hac leo integer. Risus hac part duriw feugiat litora cursus hendrerit bibendum per person on elit.Tempus inceptos posuere me.</p>
                        <a href="blog-details.html" class="news-btn">read more <i class="fa fa-long-arrow-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="single-news mt-5 mt-md-0">
                    <div class="news-img">
                        <img src="{{asset('assets/images/news2.jpg')}}" alt="" class="img-fluid">
                    </div>
                    <div class="news-text">
                        <div class="news-date">
                            22 Oct 2018
                        </div>
                        <h3><a href="blog-details.html">Galectins An Ancient FaSi Future</a></h3>
                        <p>Elementum libero hac leo integer. Risus hac part duriw feugiat litora cursus hendrerit bibendum per person on elit.Tempus inceptos posuere me.</p>
                        <a href="blog-details.html" class="news-btn">read more <i class="fa fa-long-arrow-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="single-news mt-5 mt-lg-0">
                    <div class="news-img">
                        <img src="{{asset('assets/images/news3.jpg')}}" alt="" class="img-fluid">
                    </div>
                    <div class="news-text">
                        <div class="news-date">
                            22 Sep 2018
                        </div>
                        <h3><a href="blog-details.html">Getting the Most Out of the CLARI</a></h3>
                        <p>Elementum libero hac leo integer. Risus hac part duriw feugiat litora cursus hendrerit bibendum per person on elit.Tempus inceptos posuere me.</p>
                        <a href="blog-details.html" class="news-btn">read more <i class="fa fa-long-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<footer class="footer-area section-padding">
    <div class="footer-widget">
        <div class="container">
            <div class="row">
                <div class="col-xl-2 col-lg-3">
                    <div class="single-widget-home mb-5 mb-lg-0">
                        <h3 class="mb-4">top products</h3>
                        <ul>
                            <li class="mb-2"><a href="#">managed website</a></li>
                            <li class="mb-2"><a href="#">managed reputation</a></li>
                            <li class="mb-2"><a href="#">power tools</a></li>
                            <li><a href="#">marketing service</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-5 offset-xl-1 col-lg-6">
                    <div class="single-widget-home mb-5 mb-lg-0">
                        <h3 class="mb-4">newsletter</h3>
                        <p class="mb-4">You can trust us. we only send promo offers, not a single.</p>
                        <form action="#">
                            <input type="email" placeholder="Your email here" onfocus="if (!window.__cfRLUnblockHandlers) return false; this.placeholder = ''" onblur="if (!window.__cfRLUnblockHandlers) return false; this.placeholder = 'Your email here'" required data-cf-modified-ed77345db1d323e1b61dccec-="">
                            <button type="submit" class="template-btn">subscribe now</button>
                        </form>
                    </div>
                </div>
                <div class="col-xl-3 offset-xl-1 col-lg-3">
                    <div class="single-widge-home">
                        <h3 class="mb-4">instagram feed</h3>
                        <div class="feed">
                            <img src="{{asset('assets/images/feed1.jpg')}}" alt="feed">
                            <img src="{{asset('assets/images/feed2.jpg')}}" alt="feed">
                            <img src="{{asset('assets/images/feed3.jpg')}}" alt="feed">
                            <img src="{{asset('assets/images/feed4.jpg')}}" alt="feed">
                            <img src="{{asset('assets/images/feed5.jpg')}}" alt="feed">
                            <img src="{{asset('assets/images/feed6.jpg')}}" alt="feed">
                            <img src="{{asset('assets/images/feed7.jpg')}}" alt="feed">
                            <img src="{{asset('assets/images/feed8.jpg')}}" alt="feed">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-copyright">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-6">
<span>

Copyright &copy;<script type="ed77345db1d323e1b61dccec-text/javascript">document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>

</span>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="social-icons">
                        <ul>
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                            <li><a href="#"><i class="fa fa-behance"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>


{{--<script src="{{asset('assets/js/vendor/jquery-2.2.4.min.js')}}" type="ed77345db1d323e1b61dccec-text/javascript"></script>--}}
{{--<script src="{{asset('assets/js/vendor/bootstrap-4.1.3.min.js')}}" type="ed77345db1d323e1b61dccec-text/javascript"></script>--}}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="{{asset('assets/js/vendor/wow.min.js')}}" type="ed77345db1d323e1b61dccec-text/javascript"></script>
<script src="{{asset('assets/js/vendor/owl-carousel.min.js')}}" type="ed77345db1d323e1b61dccec-text/javascript"></script>
<script src="{{asset('assets/js/vendor/jquery.datetimepicker.full.min.js')}}" type="ed77345db1d323e1b61dccec-text/javascript"></script>
<script src="{{asset('assets/js/vendor/jquery.nice-select.min.js')}}" type="ed77345db1d323e1b61dccec-text/javascript"></script>
<script src="{{asset('assets/js/vendor/superfish.min.js')}}" type="ed77345db1d323e1b61dccec-text/javascript"></script>
<script src="{{asset('assets/js/main.js')}}" type="ed77345db1d323e1b61dccec-text/javascript"></script>

<script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13" type="ed77345db1d323e1b61dccec-text/javascript"></script>
@yield('script')
<script type="ed77345db1d323e1b61dccec-text/javascript">
{{--function goTo(title){--}}
{{--    goToSection(title);--}}
{{--}--}}



  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  function toTitleCase(str) {
    return str.replace(/(?:^|\s)\w/g, function(match) {
        return match.toUpperCase();
    });
}
{{-- function goToSection(title) {--}}
{{--  title = toTitleCase(title)--}}
{{--$(".procedures-section-title").text(title);--}}
{{--//alert($(location).attr("href"));--}}

{{--    $('html,body').animate({--}}
{{--        scrollTop: $(".procedures-section").offset().top -300 },--}}
{{--        'slow');--}}
{{--}--}}
  gtag('config', 'UA-23581568-13');
</script>
<script src="https://ajax.cloudflare.com/cdn-cgi/scripts/95c75768/cloudflare-static/rocket-loader.min.js" data-cf-settings="ed77345db1d323e1b61dccec-|49" defer=""></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js" type="e61d56bd17d79316e759fdbd-text/javascript"></script>
<script src="{{asset('assets/js/vendor/products.js')}}" type="e61d56bd17d79316e759fdbd-text/javascript"></script>
<script src="{{asset('assets/js/vendor/application.min.js')}}" type="e61d56bd17d79316e759fdbd-text/javascript"></script>
<script src="https://ajax.cloudflare.com/cdn-cgi/scripts/95c75768/cloudflare-static/rocket-loader.min.js" data-cf-settings="e61d56bd17d79316e759fdbd-|49" defer=""></script></body>
</html>
