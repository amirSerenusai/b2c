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
                         <p>
                             Ventilation Tubes Insertion: 
                              
                             General: 
                             The insertion of ventilating tubes also known as tympanostomy tubes is a simple operation 
                             and the most common procedure performed by ear, nose, throat (ENT) specialists. The main
                             goal of the operation is to equalize the pressure between the middle ear and the surrounding, 
                             thus preventing the formation of negative pressure and accumulation of fluids in the middle
                             ear of patients (particularly children) in which the Eustachian tube does not function well.
                             This fluid in the middle ear is a potential ground for recurrent infections as well as a cause for
                             conductive hearing loss, and as a result - speech and language delay. The procedure

                             includes small incision in the tympanic membrane (myringotomy) and the placement of
                             pressure equalizer tubes in the tympanic membrane.

                             Indication:
                             Chronic accumulation of fluid in the middle (Serous otitis media) with or without recurrent
                             infections of the middle ear). The condition of the tympanic membrane, the degree of hearing
                             loss, the delay in language development and the number of infections are among the variables
                             which may have influence on the decision to operate.
                              
                             Description of the Procedure:
                             The procedure is being performed using a microscope and a tiny knife to make a small cut in
                             the ear drum. The fluid is removed and the ventilation tube is being placed in the hole in the
                             tympanic membranes. In children, the operation is usually being done under general
                             anesthesia. In adults, it may be performed in an office visit and under local anesthesia. 

                             Recovery Time: 
                             Usually the recovery time from the operation is a few hours depending on the influence of the
                             anesthesia on the patient. Following the surgery, antibiotic ear drops are usually prescribed
                             for a few days and the patient returns to full function.
                             The tubes placed in the eardrums, in most cases, are gradually extruded into the external ear
                             canals (usually in 6-12 months). In rare cases, should they have not fallen in two or three
                             years - they should be removed in an additional short procedure. 
                             It is important to prevent water from entering into the middle ears through the tubes by using
                             ear plugs during baths, showers and swimming, in order to prevent infections, until the tubes
                             fall out. 
                              
                             Risks associated with the procedure:                                                                               
                             The insertion of ventilating tubes is a quick and a simple procedure. The main risks of the
                             procedure are the risks associated with general anesthesia, but rarely recurrent infections can
                             occur due to water penetration,  and  a perforation of the TM may persist after the extrusion
                             of the tubes.
                              
                             Alternative Care: 
                             An alternative to ear tube insertion is to continue consuming conventional antibiotics and
                             antihistamine medication while examining periodically the existence of fluid in the middle
                             ear by an ENT specialist and checking the degree of the hearing loss.


                         </p>
                        <p class="pt-3">Subdue whales void god which living don't midst lesser yielding over lights whose. Cattle greater brought sixth fly den dry good tree isn't seed stars were.</p>
                        <p>Subdue whales void god which living don't midst lesser yielding over lights whose. Cattle greater brought sixth fly den dry good tree isn't seed stars were the boring.</p>
                        <h4 id='result'></h4>
                        <input type="email" class="form-control  delay2s  animated pulse  w-75"  id="email" placeholder="Enter email" name="email">

{{--                        <span id="info"></span>--}}
                        <input type="password" class="form-control w-75 mt-3 "  style="display: none" id="pwd" placeholder="Enter password" name="pwd">
{{--                      <div class="for-new-user w-75 mt-1" style="display: none;">--}}
{{--                          <a class="btn btn-link ml-3" id="forgotPwd" href="http://localhost/b2c/public/password/reset">--}}
{{--                              Forgot Your Password?--}}
{{--                          </a>--}}
{{--                          <div class="vl"></div>--}}
{{--                          <a class="btn btn-link " id="newUser" href="#new-user">--}}
{{--                              New user--}}
{{--                          </a></div>--}}
{{--                        <div class="for-existing-user w-75 text-center"  >--}}
{{--                            <a class="btn btn-link" id="loginUser" href="#login-user" style="display: none">--}}
{{--                                Login existing user--}}
{{--                            </a>--}}
{{--                        </div>--}}
{{--                        <button id="pwdLink" class="template-btn mt-1 disabled w-75" style="display: none"><b style="color:white;font-size: 15px;">send me a password link</b></button>--}}
{{--                        <button id="pwdLink"  type="button" class="btn btn-outline-success w-75 mb-2 mt-3" > <i class="fa fa-envelope-o" aria-hidden="true"></i>--}}
{{--                            send me a password link</button>--}}
{{--                        onclick="show('progressbar')"--}}
{{--                        href="{{route('procedures.run', $procedure->id)}}"--}}
                        <a ><button id="getDecision"  class="template-btn mt-3 w-75 c-pointer"  >
                                <b style="color:white;font-size: 15px">
                                    <i class="fa fa-envelope-o" aria-hidden="true"></i>
                                    Send me a password link!</b>
                            </button></a>

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
