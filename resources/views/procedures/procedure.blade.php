@extends ('layout')
@section ('content')

{{--        <img src="{{asset('assets/images/banner.jpg')}}" alt="" class="procedures-section">--}}
{{--    </div>--}}
<div class="flip-card  position-absolute "  style="bottom:230px;right: 300px;z-index: 100000;display: none">
    <div class="flip-card-inner">
        <div class="flip-card-front">
            {{--                    <img src="img_avatar.png" alt="Avatar" style="width:300px;height:100px;">--}}
            <i class="fa fa-envelope" aria-hidden="true" style="font-size: 80px"></i>
        </div>
        <div class="flip-card-back">
            <h3>Mail Sent!</h3>
            <p>Architect & Engineer</p>
            <p>We love that guy</p>
        </div>
    </div>
</div>
    <div class="card max-height-30" style="border:none; ">
        <img class="card-img banner-img max-height-30"  data-src="holder.js/100px260/" alt="100%x260" src="{{asset('assets/images/banners-1566213_1920.jpg')}}" data-holder-rendered="true" >
    </div>
    <section class="welcome-area section-padding">



        <div class="container">

            <div class="row">

{{--                <div class="col-lg-5 align-self-center">--}}
{{--                    <div class="welcome-img">--}}
{{--                        <img src="{{asset('assets/images/welcome.png')}}" alt="" class="procedures-section">--}}
{{--                    </div>--}}
{{--                </div>--}}
                <div class="col-lg-5 " >
{{--                    align-self-center--}}
                    <div class="welcome-img " >
                        <img src="{{asset('assets/images/welcome.png')}}" alt="" class="procedures-section" >
                    </div>
                </div>

                <div class="col-lg-7">
                    <div class="welcome-text mt-5 mt-lg-0 pt-0">

                        <h2 class="procedures-section-title mb-1">  {{$procedure->title}} </h2>

                         <p>

{{--                                <h4 id='result'></h4>--}}
{{--                        <input type="email" class="form-control  delay2s  animated pulse  w-75"  id="email" placeholder="Enter email" name="email">--}}
{{--                        <input type="password" class="form-control w-75 mt-3 "  style="display: none" id="pwd" placeholder="Enter password" name="pwd">--}}

{{--                        <a ><button id="getDecision"  class="template-btn mt-3 w-75 c-pointer"  >--}}
{{--                                <b style="color:white;font-size: 15px">--}}
{{--                                    <i class="fa fa-envelope-o" aria-hidden="true"></i>--}}
{{--                                    Send me a password link!</b>--}}
{{--                            </button></a>--}}

{{--                        <br><br><br>--}}
                        <p>                             In the following process, the system shall ask you a set of dynamic nonidentifiable questions, which are critical for the medical decision making, before facing a medical procedure. Please provide the most accurate information to receive the best outcome.</p>
                        @component('components.start-process') @endcomponent
                        @component('components.tree')        @endcomponent

{{--                        <h4>  General information: </h4>--}}

{{--                        The insertion of ventilating tubes also known as tympanostomy tubes is a simple operation  and the most common procedure performed by ear,--}}
{{--                        nose, throat (ENT) specialists.--}}
{{--                        The main goal of the operation is to equalize the pressure between the middle ear and the surrounding,--}}
{{--                        thus preventing the formation of negative pressure and accumulation of fluids in the middle ear of patients--}}
{{--                        (particularly children) in which the Eustachian tube does not function well.--}}
{{--                        This fluid in the middle ear is a potential ground for recurrent infections as well as a cause for conductive hearing loss,--}}
{{--                        and as a result - speech and language delay.--}}
{{--                        The procedure includes small incision in the tympanic membrane (myringotomy) and the placement of pressure equalizer tubes in the tympanic membrane.--}}



                    </div>

                    </div>

{{--                <div class="col-lg-7">--}}
{{--                    <div class="welcome-text mt-5 mt-lg-0">--}}
{{--                        <h2 class="procedures-section-title">Welcome to our clinic</h2>--}}
{{--                        <p class="pt-3">Subdue whales void god which living don't midst lesser yielding over lights whose. Cattle greater brought sixth fly den dry good tree isn't seed stars were.</p>--}}
{{--                        <p>Subdue whales void god which living don't midst lesser yielding over lights whose. Cattle greater brought sixth fly den dry good tree isn't seed stars were the boring.</p>--}}
{{--                        <a href="#" class="template-btn mt-3">learn more</a>--}}
{{--                    </div>--}}
{{--                </div>--}}



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

</div>

@endsection



@section ('script')


    <script>
        const URL = "{{  substr(url()->current(), strrpos(url()->current(), '/') + 1)   }}"

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
            // alert(URL)
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



        function goAmir2() {
            alert("pwdlink")
        }
        $("#loginUser").on('click', function()  {
            $(".for-new-user").show();
            $(".for-existing-user").hide();
            $("#email").attr("placeholder", "Enter email");
            $("#pwd").slideDown(300);
            $("#pwdLink").slideUp(300);
        });



    </script>
    <script src="{{asset('js/custom_functions.js')}}"></script>
@endsection
