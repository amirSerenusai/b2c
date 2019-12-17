@extends ('layout')
@section ('content')

    <div class="card max-height-30" style="border:none; ">
        <img class="card-img banner-img max-height-30"  data-src="holder.js/100px260/" alt="100%x260" src="{{asset('assets/images/banners-1566213_1920.jpg')}}" data-holder-rendered="true" >
    </div>
    <section class="feature-area section-padding">

        <div class="row">
            <div class="col-lg-6 offset-lg-3">
                <div class="section-top text-center">
                    <h2>ABOUT US</h2>
                    <p>An awarding winning and patented technology, MySerenus™ (patent-pending) is an
                        innovative AI-based informative platform developed for informed and optimized medical
                        decisions, minimizing risks and saving lives.
                        The innovative system uses unique algorithms that replicate the decision-making process of
                        top and objective physicians by combining the best and most updated evidence based medical
                        practice, professionals’ knowledge and machine learning technologies.
                        In the following process, the system shall ask you a set of dynamic nonidentifiable questions,
                        which are critical for the medical decision making, before facing a medical procedure. Please
                        provide the most accurate information to receive the best outcome.</p>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="single-feature text-center item-padding">
                        <img src="{{asset('assets/images/feature1.png')}}" alt="">
                        <h3>factors</h3>
                        <p class="pt-3">Know the critical factors for the decision-making</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="single-feature text-center item-padding mt-4 mt-md-0">
                        <img src="{{asset('assets/images/feature2.png')}}" alt="">
                        <h3>medical practices</h3>
                        <p class="pt-3">Become updated with evidence based medical practices</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="single-feature text-center item-padding mt-4 mt-lg-0">
                        <img src="{{asset('assets/images/feature3.png')}}" alt="">
                        <h3>conservative measures</h3>
                        <p class="pt-3">Be informed of alternative conservative measures, before going under a risky
                            procedure.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="single-feature text-center item-padding mt-4 mt-lg-0">
                        <img src="{{asset('assets/images/feature4.png')}}" alt="">
                        <h3>friendly staff</h3>
                        <p class="pt-3">Creeping for female light years that lesser can't evening heaven isn't bearing tree appear</p>
                    </div>
                </div>
            </div>

            <div class="jumbotron jumbotron-fluid " style="margin-top: 130px;padding:20px">
                <div class="container" style="">
{{--                    <h1>Bootstrap Tutorial</h1>--}}
                    <div data-v-50d8709d="" role="alert" class="el-alert disclaimer el-alert--info is-light"><!----><div class="el-alert__content"><span class="el-alert__title is-bold">Disclaimer:</span><p class="el-alert__description"><p data-v-50d8709d=""><strong data-v-50d8709d="">Serenus.AI™</strong> ("System") is a system designed to assist professionals with their control of the medical procedures decision-making process before medical procedures. In no way, shall the System be used as a decisive factor for a medical procedure and the medical practitioners shall always have sole discretion whether or not to perform a medical procedure. In no event shall Serenus.AI Ltd. be responsible or liable for any damage caused or sustained in connection with the performance or a decision not to perform a medical procedure connection with the use of the System. </p> <p data-v-50d8709d=""><strong data-v-50d8709d="">Intellectual Property retention:</strong> All rights, title and interest in and to the Serenus.AI™ trade name and the System, including without limitation,software, algorithm, reports , user interface, design , questionnaire and/or any material related thereto vest solely in Serenus.AI Ltd.
                            </p> <p data-v-50d8709d=""><strong data-v-50d8709d="">Serenus.AI Confidential and Proprietary Information:</strong> The user undertakes to maintain in strict confidentiality all information relating to the system among others its technical data, its commercial data, its algorithm, its methods, its knowledge, its data, its machine learning methods and modules, its diagrams and any further information whether written or oral ("Confidential וnformation”). The confidential Information shall not be used in any way directly or indirectly or disclosed by the user. The user shall not make any copy of any part of the system and shall return any material connected with the system to the company upon the end of the usage.
                            </p> <p data-v-50d8709d=""><strong data-v-50d8709d="">Any questions?</strong> Feel free to contact us at: +972-54-3155222 | info@serenusai.com
                            </p> <!----><i class="el-alert__closebtn el-icon-close"></i></div></div>
                </div>
            </div>
        </div>

    </section>





{{--<div class="local-preloader " style="display: none; left: 47% ;height: 60px">--}}
{{--    <div class="spinner"  ></div>--}}
{{--</div>--}}
{{--<div class="locspin" style="position: absolute;width: 100%; display: none">--}}
{{--<div class="spinner  " ></div>--}}
{{--</div>--}}

{{--<div class="login-steps" >--}}

{{--        <ul class="progressbar progress-bar-flex">--}}
{{--            <li class="c1 active shadow">Enter email</li>--}}
{{--            <li class="c2">Choose password</li>--}}
{{--            <li class="c3">Fill case</li>--}}
{{--            <li>View map</li>--}}
{{--        </ul>--}}

{{--</div>--}}

@endsection



{{--@section ('script')--}}


{{--    <script>--}}
{{--        const URL = "{{  substr(url()->current(), strrpos(url()->current(), '/') + 1)   }}"--}}

{{--        let cItem =1;--}}

{{--        function show(className){--}}
{{--            $('html,body').animate({scrollTop:0},0);--}}
{{--            window.scrollBy({--}}
{{--                top:   600 ,--}}
{{--                behavior: 'smooth'--}}
{{--            });--}}

{{--            $(".login-steps").show().addClass('animated fadeInUp');--}}

{{--            $(".locspin").toggle().fadeOut(1300);--}}
{{--        }--}}
{{--        $(document).ready(function(){--}}
{{--            // alert(URL)--}}
{{--            console.log($("#email").val() );--}}
{{--            $(".next-step2").on("click" , function () {--}}

{{--                console.log( $(".carousel-control-next")[0].click())--}}
{{--            });--}}
{{--        });--}}


{{--        clickBack = () => { $(".carousel-control-prev")[0].click();--}}
{{--            $(`.progressbar  li.c${cItem}`).removeClass('active shadow');--}}
{{--            cItem = cItem === 1 ? 3 : cItem-1;--}}
{{--            $(`.progressbar  li.c${cItem}`).addClass('active shadow');--}}
{{--  };--}}


{{--        hideSections = () => {--}}

{{--            $(".hotline-area").hide();--}}
{{--            $(".specialist-area").hide();--}}
{{--            $(".news-area").hide();--}}
{{--            $(".footer-area ").hide();--}}
{{--            $(".progressbar").hide();--}}
{{--            // $('html,body').animate({scrollTop:$(window).scrollTop() + $(window).height()},0);--}}
{{--           // $('html,body').animate({scrollTop:0},0);--}}



{{--        };--}}

{{--        $("#newUser").on('click', function()  {--}}
{{--        //    alert("234234");--}}

{{--            $("#email").attr("placeholder", "Enter a new email");--}}
{{--            $("#pwd").slideUp(300);--}}
{{--            $(".for-new-user").hide();--}}
{{--            $(".for-existing-user").show();--}}
{{--            $("#pwdLink").slideDown(300);--}}
{{--        });--}}



{{--        function goAmir2() {--}}
{{--            alert("pwdlink")--}}
{{--        }--}}
{{--        $("#loginUser").on('click', function()  {--}}
{{--            $(".for-new-user").show();--}}
{{--            $(".for-existing-user").hide();--}}
{{--            $("#email").attr("placeholder", "Enter email");--}}
{{--            $("#pwd").slideDown(300);--}}
{{--            $("#pwdLink").slideUp(300);--}}
{{--        });--}}



{{--    </script>--}}
{{--    <script src="{{asset('js/custom_functions.js')}}"></script>--}}
{{--@endsection--}}
