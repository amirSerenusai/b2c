@extends('layout')
@section("content")
{{--    <div class="order-bg ">--}}
{{--        <img src="{{url('assets/images/order-bg.jpg')}}" alt="">--}}
{{--    </div>--}}
<div class="card max-height-30" style="border:none; ">
    <img class="card-img banner-img max-height-30"  data-src="holder.js/100px260/" alt="100%x260" src="{{asset('assets/images/banners-1566213_1920.jpg')}}" data-holder-rendered="true" >
</div>
<section class="patient-area " style="padding: 10px">
    <div class="container">
{{--        <div class="row">--}}
{{--            <div class="col-lg-6 offset-lg-3">--}}
{{--                <div class="section-top text-center">--}}
{{--                    <h2>Patient are saying</h2>--}}
{{--                    <p>Green above he cattle god saw day multiply under fill in the cattle fowl a all, living, tree word link available in the service for subdue fruit.</p>--}}
{{--                </div>--}}
{{--            </div>  --}}
{{--        </div>--}}
        <div class="row">
{{--            <div class="col-lg-12">--}}
{{--                <div class="single-patient mb-4">--}}
{{--                    <img src="{{asset('assets/images/patient1.png')}}" alt="">--}}
{{--                    <h3>daren jhonson</h3>--}}
{{--                    <h5>hp specialist</h5>--}}
{{--                    <p class="pt-3">Elementum libero hac leo integer. Risus hac road parturient feugiat. Litora cursus hendrerit bib elit Tempus inceptos posuere metus.</p>--}}
{{--                </div>--}}
{{--                <div class="single-patient">--}}
{{--                    <img src="{{asset('assets/images/patient2.png')}}" alt="">--}}
{{--                    <h3>black heiden</h3>--}}
{{--                    <h5>hp specialist</h5>--}}
{{--                    <p class="pt-3">Elementum libero hac leo integer. Risus hac road parturient feugiat. Litora cursus hendrerit bib elit Tempus inceptos posuere metus.</p>--}}
{{--                </div>--}}
{{--            </div>--}}
            <div class="col-lg-12  align-self-center ">
                <div class="appointment-form text-center mt-5 mt-lg-0 ">
                    <div class="card transparent-gradient" >
{{--                    <h3 class="mb-5">appointment now</h3>--}}
                        <div class="slam template-btn mb-30  " style="opacity: 1">
                            <h1 style="text-shadow: 2px 2px 2px black ;font-size: 5em !important; " class="h1 header text-white">EXCLUSIVE OFFER FOR YOU! </h1>
                        </div>
                    <form  >
                        <div class="form-group">
                            <input type="text" placeholder="Your Name" onfocus="if (!window.__cfRLUnblockHandlers) return false; this.placeholder = ''" onblur="if (!window.__cfRLUnblockHandlers) return false; this.placeholder = 'Your Name'" required data-cf-modified-ed77345db1d323e1b61dccec-="">
                        </div>
                        <div class="form-group">
                            <input type="email" placeholder="Your Email" onfocus="if (!window.__cfRLUnblockHandlers) return false; this.placeholder = ''" onblur="if (!window.__cfRLUnblockHandlers) return false; this.placeholder = 'Your Email'" required data-cf-modified-ed77345db1d323e1b61dccec-="">
                        </div>
                        <div class="form-group">
                            <input type="text" id="datepicker" placeholder="Date" onfocus="if (!window.__cfRLUnblockHandlers) return false; this.placeholder = ''" onblur="if (!window.__cfRLUnblockHandlers) return false; this.placeholder = 'Date'" required data-cf-modified-ed77345db1d323e1b61dccec-="">
                        </div>
                        <div class="form-group">
                            <textarea name="message" cols="20" rows="7" placeholder="Message" onfocus="if (!window.__cfRLUnblockHandlers) return false; this.placeholder = ''" onblur="if (!window.__cfRLUnblockHandlers) return false; this.placeholder = 'Message'" required data-cf-modified-ed77345db1d323e1b61dccec-=""></textarea>
                        </div>
{{--                        <a href="#" class="template-btn">appointment now</a>--}}
                        @component('components.paypal')
                        @endcomponent
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

     <div class="transparent-gradient">
{{--         <div style="height: 220px; top: 0; left:0;right:0; z-index: 0;" class="bg-white position-absolute">&nbsp;</div>--}}
    <div class="container " style="margin-top: 0; padding: 30px;">

        <div class="row bg-white" style=" box-shadow: 5px 5px 29px 10px rgba(255, 255, 255, 1);
">

            <div class="col  ">  <img width="500" src="{{url('assets/images/order-doctor.png')}}"  class="img-fluid"> </div>
            <div class="col  ">
                <div class="slam template-btn mb-30">
                    <h1 style="text-shadow: 2px 2px 2px black ;font-size: 5em !important; " class="h1 header text-white">EXCLUSIVE OFFER FOR YOU! </h1>
                </div>
                <div class="rte-wrapper">
                    <div class="comp-rich-text">
                        <p><strong>What you'll need to get started:</strong></p>
                        <p><i class="fa fa-check"></i> Your Debit Card, sort code and account number (Personal and Business customers)</p>
                        <p><i class="fa fa-check"></i> Credit card (Credit card only customers)</p>
                        <p><i class="fa fa-check"></i> Once your ready to register for Online Banking simply follow our handy step-by-step guide below.</p>
                    </div>
{{--                    @component('paypal')--}}
{{--                    @endcomponent--}}
                </div>
            </div></div>
{{--            <div class="w-100 border "> <img  style="width: 45% ; opacity: 0.8;   margin-top: -250px " src="{{url('assets/images/hexagons-new.jpg')}}"  class="position-absolute border"></div>--}}


{{--            <div class="col border">Column</div>--}}
{{--            <div class="col border">Column</div>--}}
        </div>
    </div>

{{--        <div class="container">--}}
{{--   <div class="clearfix ">--}}
{{--       <div class="float-left">--}}
{{--           <img  style="width: 500px ; margin-top: 100px;margin-left: 50px" src="{{url('assets/images/order-doctor.png')}}"  class="img-fluid      ">--}}

{{--       </div>--}}
{{--       <div class="float-left clearfix" style="padding-top: 200px" >--}}
{{--       <div class="d-inline-block slam template-btn" style="--}}



{{--">--}}
{{--           <h1 style="text-shadow: 2px 2px 2px black ;font-size: 5em !important; " class="h1 header text-white">EXCLUSIVE OFFER FOR YOU!</h1>--}}
{{--       </div>--}}
{{--           <br><br><br>--}}
{{--             <div class= "offset-3" >--}}
{{--                 <div class="title-wrapper">--}}
{{--                     <h2 class="title-comp  ">--}}
{{--                         How to register for Online Banking--}}
{{--                     </h2>--}}

{{--                 <div class="rte-wrapper">--}}
{{--                     <div class="comp-rich-text">--}}
{{--                         <p><strong>What you'll need to get started:</strong></p>--}}
{{--                         <p><i class="fa fa-check"></i> Your Debit Card, sort code and account number (Personal and Business customers)</p>--}}
{{--                         <p><i class="fa fa-check"></i> Credit card (Credit card only customers)</p>--}}
{{--                         <p><i class="fa fa-check"></i> Once your ready to register for Online Banking simply follow our handy step-by-step guide below.</p>--}}
{{--                     </div>--}}

{{--                 </div>--}}
{{--             </div>--}}
{{--         </div>--}}
{{--   </div>--}}
{{--   </div>--}}
{{--   <div>--}}
{{--       <img  style="width: 40% ; opacity: 0.8;   margin-top: -200px;margin-left: 50px" src="{{url('assets/images/hexagons-new.jpg')}}"  class="img-fluid border">--}}
{{--   </div>--}}

{{--        </div>--}}
@endsection

