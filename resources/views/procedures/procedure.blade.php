@extends ('layout')
@section ('content')

{{--        <img src="{{asset('assets/images/banner.jpg')}}" alt="" class="procedures-section">--}}
{{--    </div>--}}
{{--<div class="flip-card  position-absolute "  style="bottom:230px;right: 300px;z-index: 100000;display: none">--}}
{{--    <div class="flip-card-inner">--}}
{{--        <div class="flip-card-front">--}}
{{--            --}}{{--                    <img src="img_avatar.png" alt="Avatar" style="width:300px;height:100px;">--}}
{{--            <i class="fa fa-envelope" aria-hidden="true" style="font-size: 80px"></i>--}}
{{--        </div>--}}
{{--        <div class="flip-card-back">--}}
{{--            <h3>Mail Sent!</h3>--}}
{{--            <p>Architect & Engineer</p>--}}
{{--            <p>We love that guy</p>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
    <div class="card max-height-30" style="border:none; ">
        <img class="card-img banner-img max-height-30"  data-src="holder.js/100px260/" alt="100%x260" src="{{asset('assets/images/banners-1566213_1920.jpg')}}" data-holder-rendered="true" >
    </div>
    <section class="welcome-area">



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

                        <h2 class="procedures-section-title mb-1">Considering {{$procedure->title}} ?  </h2>

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
{{--                        <p>                             In the following process, the system shall ask you a set of dynamic nonidentifiable questions, which are critical for the medical decision making, before facing a medical procedure. Please provide the most accurate information to receive the best outcome.</p>--}}

                            <h3> Enhance your knowledge, before a risky medical procedure</h3>

                        <p><i class="fa fa-check"></i> An awarding winning and patented AI-based technology.</p>
                        <i class="fa fa-check float-left" style="line-height: 1.8">&nbsp; </i> <div class="indent-first ml-3"> Get a professional personalized report with all the critical factors that you should consider before a risky procedure.
                        </div>
                        <p><i class="fa fa-check"></i> Become updated with evidence based medical practices.</p>
                        <p><i class="fa fa-check"></i> Be informed of alternative conservative measures.</p>
                        <p><i class="fa fa-check"></i> Developed by world renowned specialists.</p>
                         <i class="fa fa-check float-left" style="line-height: 2.0">&nbsp; </i> <div class="indent-first ml-3"> <div id="odometer" class="odometer"   >0000001</div> ANALYZED CASES , 107,000 WORKED HOURS,100 PROCEDURES
                        </div>
                        @component('components.start-process') @endcomponent
{{--                        @component('components.tree')        @endcomponent--}}





                    </div>

                    </div>



                </div>

            </div>


    </section>

<section class="specialist-area ">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3">
                <div class="section-top text-center">
                    <h2>General information</h2>
                    <p >The insertion of ventilating tubes also known as tympanostomy tubes is a simple operation  and the most common procedure performed by ear,
                        nose, throat (ENT) specialists.
                        The main goal of the operation is to equalize the pressure between the middle ear and the surrounding,
                        thus preventing the formation of negative pressure and accumulation of fluids in the middle ear of patients
                        (particularly children) in which the Eustachian tube does not function well.
                        This fluid in the middle ear is a potential ground for recurrent infections as well as a cause for conductive hearing loss,
                        and as a result - speech and language delay.
                        The procedure includes small incision in the tympanic membrane (myringotomy) and the placement of pressure equalizer tubes in the tympanic membrane.</p>
                </div>
            </div>




        </div>
        <div class="row">
            <div class="col-lg-3 col-sm-6">
                <div class="single-doctor mb-4 mb-lg-0">
                    <div class="doctor-img">
                    </div>
                    <div class="content-area">
                        <div class="doctor-name text-center">
                            <h3>Indication</h3>
{{--                            <div class="toggle-content"  >--}}
{{--                                <h6 >Chronic accumulation of fluid in the middle (Serous otitis media) with or without recurrent infections of the middle ear). The condition of the tympanic membrane, the degree of hearing loss, the delay in language development and the number of infections are among the variables which may have influence on the decision to operate.--}}
{{--                                    sr. faculty data science</h6>--}}
{{--                            </div>--}}

                        </div>
                        <div class="doctor-text text-center toggle-content">
                            <p>Chronic accumulation of fluid in the middle (Serous otitis media) with or without recurrent infections of the middle ear). The condition of the tympanic membrane, the degree of hearing loss, the delay in language development and the number of infections are among the variables which may have influence on the decision to operate.
                                sr. faculty data science.</p>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="single-doctor mb-4 mb-lg-0">

                    <div class="content-area">
                        <div class="doctor-name text-center">
                            <h3>Description of the Procedure</h3>

                        </div>
                        <div class="doctor-text text-center toggle-content">
{{--                            <p>If you are looking at blank cassettes on the web, you may be very confused at the.</p>--}}
                            <p >The insertion of ventilating tubes is a quick and a simple procedure. The main risks of the procedure are the risks associated with general anesthesia, but rarely recurrent infections can occur due to water penetration,  and  a perforation of the TM may persist after the extrusion of the tubes.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="single-doctor mb-4 mb-sm-0">
                    <div class="doctor-img">
                    </div>
                    <div class="content-area">
                        <div class="doctor-name text-center">
                            <h3>Recovery Time</h3>
                        </div>
                        <div class="doctor-text text-center toggle-content">
                            <p> Usually the recovery time from the operation is a few hours depending on the influence of the anesthesia on the patient. Following the surgery, antibiotic ear drops are usually prescribed for a few days and the patient returns to full function.
                                The tubes placed in the eardrums, in most cases, are gradually extruded into the external ear canals (usually in 6-12 months). In rare cases, should they have not fallen in two or three years - they should be removed in an additional short procedure. 
                                It is important to prevent water from entering into the middle ears through the tubes by using ear plugs during baths, showers and swimming, in order to prevent infections, until the tubes fall out. 
                            </p>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="single-doctor">
                    <div class="doctor-img">

                    </div>
                    <div class="content-area">
                        <div class="doctor-name text-center">
                            <h3>Risks associated with the procedure</h3>
                        </div>
                        <div class="doctor-text text-center toggle-content">
                            <p>Chronic accumulation of fluid in the middle (Serous otitis media) with or without recurrent infections of the middle ear). The condition of the tympanic membrane, the degree of hearing loss, the delay in language development and the number of infections are among the variables which may have influence on the decision to operate.</p>
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

        <div class="section-padding">@component('components.disclaimer')        @endcomponent</div>
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


    <!--suppress VueDuplicateTag -->
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

        $(".content-area").hover(
              function() {
               $(this).find('.toggle-content').height('450px').css({opacity : 1})
                // $('.toggle-content').height('250px');
            },  function() {
                   $('.toggle-content').height("0px").css({opacity : 0});

            }
        );

    </script>
    <!--suppress VueDuplicateTag -->
    <script src="{{asset('js/custom_functions.js')}}"></script>
@endsection
