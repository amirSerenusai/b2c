@extends ('main')
@section ('content')
{{--        <img src="{{asset('assets/images/banner.jpg')}}" alt="" class="procedures-section">--}}
{{--    </div>--}}
    <div class="card" style="border:none">
        <img class="card-img"  data-src="holder.js/100px260/" alt="100%x260" src="{{asset('assets/images/banners-1566213_1920.jpg')}}" data-holder-rendered="true" style="border:none;height: 260px; width: 100%; display: block;">
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
                        <h2 class="procedures-section-title">  {{$procedure->title}} </h2>
                        <p class="pt-3">Subdue whales void god which living don't midst lesser yielding over lights whose. Cattle greater brought sixth fly den dry good tree isn't seed stars were.</p>
                        <p>Subdue whales void god which living don't midst lesser yielding over lights whose. Cattle greater brought sixth fly den dry good tree isn't seed stars were the boring.</p>
                        <button onclick="show('progressbar')" class="template-btn mt-3 c-pointer">Get immediate second opinion!</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
<div class="container" >
    <div class="local-preloader" style="display: none;"><div class="spinner"  style="display: block"></div></div>
    <ul class="progressbar">
        <li class="active">login</li>
        <li>choose interest</li>
        <li>add friends</li>
        <li>View map</li>
    </ul>
</div>
@endsection
@section ('script')
    <script>
        function show(className){
            $('.local-preloader').fadeIn( 400 ).fadeOut( 400 );
            $(`.${className}`).delay(100).fadeIn( 400 )
        }
        $(document).ready(function(){
          $('.progressbar').hide();
        });


    </script>
@endsection
