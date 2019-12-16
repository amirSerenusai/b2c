@extends ('layout')
@section ('content')

{{--    <div class="jumbotron">--}}
{{--        <img src="{{asset('assets/images/banner.jpg')}}" alt="" class="procedures-section">--}}
{{--    </div>--}}
    <div class="card" style="border:none">
        <img class="card-img"  data-src="holder.js/100px260/" alt="100%x260" src="{{asset('assets/images/banners-1566213_1920.jpg')}}" data-holder-rendered="true" style="border:none;height: 260px; width: 100%; display: block;">
    </div>

<section class="department-area section-padding4 proceduresSection " style="background-color: rgba(0,0,0,0)">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3">
                <div class="section-top text-center">
                    <h2>Pick a procedure</h2>
                    <p>Green above he cattle god saw day multiply under fill in the cattle fowl a all, living, tree word link available in the service for subdue fruit.</p>
                    <button onclick="goTo('learnMore')" class="template-btn mt-3">Why SerenusAI?</button>
                </div>

            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="department-slider owl-carousel">
                    <div class="single-slide">
                        <div class="slide-img">
                            <img src="{{asset('assets/images/department1.jpg')}}" alt="" class="img-fluid">
                            <div class="hover-state">
                                <a href="#"><i class="fa fa-stethoscope"></i></a>
                            </div>
                        </div>
                        <div class="single-department item-padding text-center">
                            <h3>Tonsillectomy</h3>
                            <p>Hath creeping subdue he fish gred face whose spirit that seasons today multiply female midst upon</p>
                        </div>
                    </div>
                    <div class="single-slide">
                        <div class="slide-img">
                            <img src="{{asset('assets/images/department2.jpg')}}" alt="" class="img-fluid">
                            <div class="hover-state">
                                <a href="departments.html"><i class="fa fa-stethoscope"></i></a>
                            </div>
                        </div>
                        <div class="single-department item-padding text-center">
                            <h3>Knee Replacement</h3>
                            <p>Hath creeping subdue he fish gred face whose spirit that seasons today multiply female midst upon</p>
                        </div>
                    </div>
                    <div class="single-slide">
                        <div class="slide-img">
                            <img src="{{asset('assets/images/department3.jpg')}}" alt="" class="img-fluid">
                            <div class="hover-state">
                                <a href="departments.html"><i class="fa fa-stethoscope"></i></a>
                            </div>
                        </div>
                        <div class="single-department item-padding text-center">
                            <h3>Ventilation Tubes</h3>
                            <p>Hath creeping subdue he fish gred face whose spirit that seasons today multiply female midst upon</p>
                        </div>
                    </div>
                    <div class="single-slide">
                        <div class="slide-img">
                            <img src="{{asset('assets/images/department1.jpg')}}" alt="" class="img-fluid">
                            <div class="hover-state">
                                <a href="departments.html"><i class="fa fa-stethoscope"></i></a>
                            </div>
                        </div>
                        <div class="single-department item-padding text-center">
                            <h3>cardiac clinic</h3>
                            <p>Hath creeping subdue he fish gred face whose spirit that seasons today multiply female midst upon</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="feature-area section-padding learnMore" style="background-color: none">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="single-feature text-center item-padding">
                    <img src="http://localhost/b2c/public/assets/images/feature1.png" alt="">
                    <h3>advance technology</h3>
                    <p class="pt-3">Creeping for female light years that lesser can't evening heaven isn't bearing tree appear</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="single-feature text-center item-padding mt-4 mt-md-0">
                    <img src="http://localhost/b2c/public/assets/images/feature2.png" alt="">
                    <h3>comfortable place</h3>
                    <p class="pt-3">Creeping for female light years that lesser can't evening heaven isn't bearing tree appear</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="single-feature text-center item-padding mt-4 mt-lg-0">
                    <img src="http://localhost/b2c/public/assets/images/feature3.png" alt="">
                    <h3>quality equipment</h3>
                    <p class="pt-3">Creeping for female light years that lesser can't evening heaven isn't bearing tree appear</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="single-feature text-center item-padding mt-4 mt-lg-0">
                    <img src="http://localhost/b2c/public/assets/images/feature4.png" alt="">
                    <h3>friendly staff</h3>
                    <p class="pt-3">Creeping for female light years that lesser can't evening heaven isn't bearing tree appear</p>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 offset-lg-3">
            <div class="section-top text-center">
                <button onclick="goTo('proceduresSection')" class="template-btn mt-3">back to top</button>
            </div>
        </div>
    </div>
</section>

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
                        <h2 class="procedures-section-title">Welcome to our PROCEDURES ROUTE clinic</h2>
                        <p class="pt-3">Subdue whales void god which living don't midst lesser yielding over lights whose. Cattle greater brought sixth fly den dry good tree isn't seed stars were.</p>
                        <p>Subdue whales void god which living don't midst lesser yielding over lights whose. Cattle greater brought sixth fly den dry good tree isn't seed stars were the boring.</p>
                        <button onclick="goto('learnMore')" class="template-btn mt-3">Get immediate second opinion!</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
@section ('script')
    <script>

        function goTo(title){
            goToSection(title);
        }
        function toTitleCase(str) {
            return str.replace(/(?:^|\s)\w/g, function(match) {
                return match.toUpperCase();
            });
        }
        function goToSection(title) {
           // title = toTitleCase(title);
            $(".procedures-section-title").text(title);
//alert($(location).attr("href"));
//             $('html,body').animate({
//                     // scrollTop: $("."+title).offset().top -300 },
//                     // scrollTop: $("."+title).offset().top -100 },
//                 'slow');
        }
    </script>
@endsection
