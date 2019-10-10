@extends ('main')
@section ('content')
{{--        <img src="{{asset('assets/images/banner.jpg')}}" alt="" class="procedures-section">--}}
{{--    </div>--}}
    <div class="card max-height-30" style="border:none; ">
        <img class="card-img banner-img max-height-30"  data-src="holder.js/100px260/" alt="100%x260" src="{{asset('assets/images/banners-1566213_1920.jpg')}}" data-holder-rendered="true" >
    </div>
    <section class="welcome-area section-padding3">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 align-self-center">
                    <div class="welcome-img">
                        <img src="{{asset('assets/images/welcome.png')}}" alt="" class="procedures-section">
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="welcome-text mt-5 mt-lg-0">
                        <h2 class="procedures-section-title ">  {{$procedure->title}} </h2>
                        <p class="pt-3">Subdue whales void god which living don't midst lesser yielding over lights whose. Cattle greater brought sixth fly den dry good tree isn't seed stars were.</p>
                        <p>Subdue whales void god which living don't midst lesser yielding over lights whose. Cattle greater brought sixth fly den dry good tree isn't seed stars were the boring.</p>
                        <button onclick="show('progressbar')" class="template-btn mt-3 c-pointer delay2s  animated heartBeat"><b style="color:white;font-size: 16px">Get immediate second opinion!</b></button>
                    </div>
                </div>
            </div>
        </div>
    </section>
<div class="local-preloader " style="display: none; left: 47% ;height: 60px">
    <div class="spinner"  ></div>
</div>
<div class="locspin" style="position: absolute;width: 100%; display: none">
<div class="spinner  " ></div>
</div>

<div class="login-steps">
    <div class="container"  style="width: 100%;">
        <ul class="progressbar">
            <li class="c1 active shadow">Enter email</li>
            <li class="c2">Choose password</li>
            <li class="c3">Fill case</li>
{{--            <li>View map</li>--}}
        </ul>
    </div>
    <div id="carouselExampleControls" class="carousel slide "  data-ride="carousel"   data-interval="false">

        <div class="carousel-inner">
            <div class="carousel-item  active">
                <div class="w-100">@component("components.enter_email")@endcomponent </div>
            </div>
            <div class="carousel-item ">
                <div class="w-100" >@component("components.login_quick")@endcomponent</div>
            </div>
            <div class="carousel-item  ">
                <div class="w-100  bg-danger" >
                    <div  class="i-frame">
                        <iframe  ></iframe>
                    </div></div>
            </div>

        </div>
        <button     class="template-btn mt-3 next-step position-absolute" style="left:49%" onclick="clickNext()">next step</button>
        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" style="display: none"   data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" style="display: none" data-slide="next">
            <span class="carousel-control-next-icon bg-success" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</div>



</div>

@endsection



@section ('script')
    <script>
        let cItem =1;
        // let up = false;
        function show(className){
            $('html,body').animate({scrollTop:0},0);
        // $(".section-padding3").css({"-webkit-animation-duration": "2000ms"}).addClass('animated zoomOut').slideUp();
        // console.log($(".section-padding3"));
        // // $(".quick-login").show();
        //     $(".enter-email").show();
            window.scrollBy({
                top:   600 ,
                behavior: 'smooth'
            });

            //$("#carouselExampleControls").show().addClass('animated fadeInUp');
            $(".login-steps").show().addClass('animated fadeInUp');

            // $("#carouselExampleControls").animate({height:'1600px'},300);

            // up = !up;

            // $('.local-preloader').animate({opacity: 'toggle' }, 'slow').delay(500).slideUp(400);

            $(".locspin").toggle().fadeOut(1300);
         //   $(`.${className}`).delay(500).show();
        }
        $(document).ready(function(){
          //$('.progressbar').hide();

          // $('html,body').animate({scrollTop:0},0);
            $(".next-step2").on("click" , function () {

                console.log( $(".carousel-control-next")[0].click())
            });
        });
  clickNext = () => { $(".carousel-control-next")[0].click();
  //console.log($(`.progressbar  li c${cItem}`));
      $(`.progressbar  li.c${cItem}`).removeClass('shadow');
      cItem = cItem === 3 ? 1 : cItem+1;
      $(`.progressbar  li.c${cItem}`).addClass('active shadow');
  };

        // $(".next-step").on("click" , function () {
        //     $('html, body').css('overflowY', 'hidden');
        //     $(".quick-login").removeClass('fadeInRightBig').addClass("animated fadeOutRightBig d-inline-block overflow-hidden");
        //     setTimeout(()=>{
        //         $(".quick-login").remove();
        //         $(".i-frame").fadeIn(1500);
        //     },500);
        //     //Start Questionnaire :
        //     hideSections();
        // });

        hideSections = () => {

            $(".hotline-area").hide();
            $(".specialist-area").hide();
            $(".news-area").hide();
            $(".footer-area ").hide();
            $(".progressbar").hide();
            // $('html,body').animate({scrollTop:$(window).scrollTop() + $(window).height()},0);
           // $('html,body').animate({scrollTop:0},0);



        }
        @yield('enter-email-script')
    </script>
@endsection
