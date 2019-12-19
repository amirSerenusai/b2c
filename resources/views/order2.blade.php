@extends('layout')
@section("content")
    {{--    <div class="order-bg ">--}}
    {{--        <img src="{{url('assets/images/order-bg.jpg')}}" alt="">--}}
    {{--    </div>--}}
    <div class="transparent-gradient">
        <div style="height: 220px; top: 0; left:0;right:0; z-index: 0;" class="bg-white position-absolute">&nbsp;</div>
        <div class="container " style="margin-top: 220px; padding: 30px;">

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
                        @component('components.paypal')
                        @endcomponent
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

