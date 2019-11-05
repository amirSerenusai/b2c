@extends ('layout')
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
                        <h2 class="procedures-section-title mb-1">  {{$procedure->title}} </h2>
                        <p class="pt-3">Subdue whales void god which living don't midst lesser yielding over lights whose. Cattle greater brought sixth fly den dry good tree isn't seed stars were.</p>
                        <p>Subdue whales void god which living don't midst lesser yielding over lights whose. Cattle greater brought sixth fly den dry good tree isn't seed stars were the boring.</p>
                        <input type="email" class="form-control  delay2s  animated pulse  w-75"  id="email" placeholder="Enter email" name="email">
                        <span id="info"></span>
                        <input type="password" class="form-control w-75 mt-3 " id="pwd" placeholder="Enter password" name="pwd">
                      <div class="for-new-user w-75 mt-1">
                          <a class="btn btn-link ml-3" id="forgotPwd" href="http://localhost/b2c/public/password/reset">
                              Forgot Your Password?
                          </a>
                          <div class="vl"></div>
                          <a class="btn btn-link " id="newUser" href="#new-user">
                              New user
                          </a></div>
                        <div class="for-existing-user" style="display: none">
                            <a class="btn btn-link " id="loginUser" href="#login-user">
                                Login existing user
                            </a>
                        </div>
{{--                        <button id="pwdLink" class="template-btn mt-1 disabled w-75" style="display: none"><b style="color:white;font-size: 15px;">send me a password link</b></button>--}}
                        <button id="pwdLink" type="button" class="btn btn-outline-success w-75 mb-2" style="display: none"> <i class="fa fa-envelope-o" aria-hidden="true"></i>
                            send me a password link</button>
                        <button onclick="show('progressbar')" disabled class="template-btn mt-1 disabled w-75   "><b style="color:white;font-size: 15px">Get immediate second opinion!</b></button>
                    </div>

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

<div class="login-steps" >

        <ul class="progressbar progress-bar-flex">
            <li class="c1 active shadow">Enter email</li>
            <li class="c2">Choose password</li>
            <li class="c3">Fill case</li>
{{--            <li>View map</li>--}}
        </ul>

{{--    <div id="carouselExampleControls" class="carousel slide mt-4"  data-ride="carousel"   data-interval="false">--}}

{{--        <div class="carousel-inner">--}}
{{--            <div class="carousel-item  active">--}}
{{--                <div class="w-100">@component("components.enter_email")@endcomponent </div>--}}
{{--            </div>--}}
{{--            <div class="carousel-item ">--}}
{{--                <div class="w-100" >@component("components.login_quick")@endcomponent</div>--}}
{{--            </div>--}}
{{--            <div class="carousel-item bg-secondary">--}}
{{--                <div class="w-100" >--}}
{{--                    <div  class="i-frame bg-dark">--}}
{{--                        loading case, please wait.....--}}
{{--                        <iframe></iframe>--}}
{{--                    </div></div>--}}
{{--            </div>--}}

{{--        </div>--}}
{{--        <div class=" position-absolute" style="left:42.35%; " >--}}
{{--        <button     class="template-btn mt-3 prev-step step1" onclick="clickBack()">step back</button>--}}
{{--        <button     class="template-btn mt-3 next-step step1" >next step</button>--}}
{{--        </div>--}}
{{--        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" style="display: none"   data-slide="prev">--}}
{{--            <span class="carousel-control-prev-icon" aria-hidden="true"></span>--}}
{{--            <span class="sr-only">Previous</span>--}}
{{--        </a>--}}
{{--        <a class="carousel-control-next" href="#carouselExampleControls" role="button" style="display: none" data-slide="next">--}}
{{--            <span class="carousel-control-next-icon bg-success" aria-hidden="true"></span>--}}
{{--            <span class="sr-only">Next</span>--}}
{{--        </a>--}}
{{--    </div>--}}
{{--</div>--}}



</div>

@endsection



@section ('script')


    <script>
        let cItem =1;

        function show(className){
            $('html,body').animate({scrollTop:0},0);
            window.scrollBy({
                top:   600 ,
                behavior: 'smooth'
            });

            $(".login-steps").show().addClass('animated fadeInUp');

            $(".locspin").toggle().fadeOut(1300);
        }
        $(document).ready(function(){
            console.log($("#email").val() );
            $(".next-step2").on("click" , function () {

                console.log( $(".carousel-control-next")[0].click())
            });
        });


        clickBack = () => { $(".carousel-control-prev")[0].click();
            $(`.progressbar  li.c${cItem}`).removeClass('active shadow');
            cItem = cItem === 1 ? 3 : cItem-1;
            $(`.progressbar  li.c${cItem}`).addClass('active shadow');
  };


        hideSections = () => {

            $(".hotline-area").hide();
            $(".specialist-area").hide();
            $(".news-area").hide();
            $(".footer-area ").hide();
            $(".progressbar").hide();
            // $('html,body').animate({scrollTop:$(window).scrollTop() + $(window).height()},0);
           // $('html,body').animate({scrollTop:0},0);



        };

        $("#newUser").on('click', function()  {
        //    alert("234234");
            $("#email").attr("placeholder", "Enter a new email");
            $("#pwd").slideUp(300);
            $(".for-new-user").hide();
            $(".for-existing-user").show();
            $("#pwdLink").slideDown(300);
        });



        $("#loginUser").on('click', function()  {
            $(".for-new-user").show();
            $(".for-existing-user").hide();
            $("#email").attr("placeholder", "Enter email");
            $("#pwd").slideDown(300);
            $("#pwdLink").slideUp(300);
        });
            $("#email").on('input', function()  {
            console.log(this);


        });
    </script>
    <script src="{{asset('js/custom_functions.js')}}"></script>
@endsection
