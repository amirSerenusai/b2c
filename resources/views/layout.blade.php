
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta name="api-base-url" content="{{ url('/') }}" />
    <title>B2c | Cosutmer </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />

{{--    <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" media="screen">--}}

{{--    <link href="{{asset('assets/css/template.css')}}" rel="stylesheet" media="screen">--}}
{{--    <script type="e61d56bd17d79316e759fdbd-text/javascript">if ( top !== self ) top.location.replace( self.location.href );// Hey, don't iframe my iframe!</script>--}}

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700,800,300" rel='stylesheet' type='text/css'>
    <link rel="shortcut icon" href="{{asset('assets/images/logo/favicon.png')}}" type="image/x-icon">

    <link rel="stylesheet" href="{{asset('assets/css/animate-3.7.0.css')}}">

    <link rel="stylesheet" href="{{asset('assets/css/bootstrap-4.1.3.min.css')}}">

    <link rel="stylesheet" href="{{asset('assets/css/owl-carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/jquery.datetimepicker.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/linearicons.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/send_mail.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/font-awesome-4.7.0.min.css')}}">
    <link rel="stylesheet"  href="https://cdn.linearicons.com/free/1.0.0/icon-font.min.css">
    <!--[if lt IE 9]>
    <script>/*@cc_on'abbr article aside audio canvas details figcaption figure footer header hgroup mark meter nav output progress section summary subline time video'.replace(/\w+/g,function(n){document.createElement(n)})@*/</script>
    <![endif]-->
</head>
<body   @if (Request::path() == 'procedures')  background="assets/images/watercolor-939784_960_720.jpg" style="background-size: 100%;"  @endif >

<div class="preloader">
    <div class="spinner"></div>
</div>


<header class="header-area max-height-30">
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
                    <a href="{{url('/')}}"><img src="{{asset('assets/images/logo/logo.png')}}" alt="" title="" /></a>
                </div>
                <nav id="nav-menu-container">
                    <ul class="nav-menu">
                        <li class="menu-active"><a href="{{url('/')}}">Home</a></li>
                        <li><a href="departments.html">departments</a></li>
                        <li><a href="{{url('/doctors')}}">doctors</a></li>
                        <li class="menu-has-children"><a href="">Pages</a>
                            <ul>
                                <li><a href="{{url('/about')}}">about us</a></li>
                                <li><a href="elements.html">elements</a></li>
                            </ul>
                        </li>
                        <li class="menu-has-children"><a href="">blog</a>
                            <ul>
                                <li><a href="{{url('/blog')}}">blog home</a></li>
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

<footer class="footer-area  pt-2">
{{--    <div class="footer-widget">--}}
{{--        <div class="container">--}}
{{--            <div class="card bg-dark">--}}
{{--                <div title="Disclaimer:" type="info" class="disclaimer">--}}
{{--                    <h4 class="text-white">Disclaimer</h4>--}}
{{--                    <p>--}}
{{--                        <strong>Serenus.AI™</strong> ("System") is a system designed to assist professionals with their control of the medical procedures decision-making process before medical procedures. In no way, shall the System be used as a decisive factor for a medical procedure and the medical practitioners shall always have sole discretion whether or not to perform a medical procedure. In no event shall Serenus.AI Ltd. be responsible or liable for any damage caused or sustained in connection with the performance or a decision not to perform a medical procedure connection with the use of the System. </p>--}}

{{--                    <p>--}}
{{--                        <strong>Intellectual Property retention:</strong> All rights, title and interest in and to the Serenus.AI™ trade name and the System, including without limitation,software, algorithm, reports , user interface, design , questionnaire and/or any material related thereto vest solely in Serenus.AI Ltd.--}}
{{--                    </p>--}}

{{--                    <p>--}}
{{--                        <strong>Serenus.AI Confidential and Proprietary Information:</strong> The user undertakes to maintain in strict confidentiality all information relating to the system among others its technical data, its commercial data, its algorithm, its methods, its knowledge, its data, its machine learning methods and modules, its diagrams and any further information whether written or oral ("Confidential וnformation”). The confidential Information shall not be used in any way directly or indirectly or disclosed by the user. The user shall not make any copy of any part of the system and shall return any material connected with the system to the company upon the end of the usage.--}}
{{--                    </p>--}}
{{--                    <p>--}}
{{--                        <strong>Any questions?</strong> Feel free to contact us at: +972-54-3155222 | info@serenusai.com--}}
{{--                    </p>--}}
{{--                </div></div>--}}

{{--        </div>--}}
{{--    </div>--}}
    <div class="footer-copyright pb-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-6">
<span>
Copyright &copy;<script type="ed77345db1d323e1b61dccec-text/javascript">document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> Colorlib


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


{{--END if is order route--}}

{{--<script src="{{asset('assets/js/vendor/jquery-2.2.4.min.js')}}" type="ed77345db1d323e1b61dccec-text/javascript"></script>--}}
{{--<script src="{{asset('assets/js/vendor/bootstrap-4.1.3.min.js')}}" type="ed77345db1d323e1b61dccec-text/javascript"></script>--}}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
{{--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>--}}
<script src="{{asset('assets/js/vendor/wow.min.js')}}" type="ed77345db1d323e1b61dccec-text/javascript"></script>
<script src="{{asset('assets/js/vendor/owl-carousel.min.js')}}" type="ed77345db1d323e1b61dccec-text/javascript"></script>
<script src="{{asset('assets/js/vendor/jquery.datetimepicker.full.min.js')}}" type="ed77345db1d323e1b61dccec-text/javascript"></script>
<script src="{{asset('assets/js/vendor/jquery.nice-select.min.js')}}" type="ed77345db1d323e1b61dccec-text/javascript"></script>
<script src="{{asset('assets/js/vendor/superfish.min.js')}}" type="ed77345db1d323e1b61dccec-text/javascript"></script>
<script src="{{asset('assets/js/main.js')}}" type="ed77345db1d323e1b61dccec-text/javascript"></script>

<script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13" type="ed77345db1d323e1b61dccec-text/javascript"></script>
<script src="{{asset('js/bootstrap.js')}}"></script>
<script src="{{asset('js/api_calls.js')}}"></script>
<script> axios.defaults.baseURL =  '{{ url("/") }}' </script>
@yield('script')
<script>
    // type="ed77345db1d323e1b61dccec-text/javascript"
{{--function goTo(title){--}}
{{--    goToSection(title);--}}
{{--}--}}


$(window).scroll(function () {

    var $this = $(this),
        $head = $('#header');
    if ($this.scrollTop() > 120) {
        $head.css({top:0});
        $head.addClass('bg-white');

    } else {
        $head.css({top:"70px"});
        $head.removeClass('bg-white');


    }
});

$(document).ready(() => {

    setTimeout(()=>{
        $("html, body").animate({ scrollTop: 0 }, "slow");
    },700);

    startEcho();
});
    // $("html, body").css('overflow','hidden') ;
function startEcho(){

    window.Echo.channel('adminserenus').listen('QuestionAnswered', e => {
        console.log({ e });
    if((typeof alertHi === "function") ) alertHi(e);
      });

}

// function validateEmailExists(myalert){alert(myalert)}
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
{{--<script src="{{asset('assets/js/vendor/products.js')}}" type="e61d56bd17d79316e759fdbd-text/javascript"></script>--}}
{{--<script src="{{asset('assets/js/vendor/application.min.js')}}" type="e61d56bd17d79316e759fdbd-text/javascript"></script>--}}
<script src="https://ajax.cloudflare.com/cdn-cgi/scripts/95c75768/cloudflare-static/rocket-loader.min.js" data-cf-settings="e61d56bd17d79316e759fdbd-|49" defer=""></script>
</body>
</html>
