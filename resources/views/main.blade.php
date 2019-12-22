@extends ('layout')
@section ('content')
    <section class="banner-area" style="background-color: rgba(0,0,0,0)">
        <div class="container">
            <div class="row">
                <div class="col-lg-5">

                    <h4>Caring for better life</h4>
{{--                    <h1>Leading the way in medical excellence</h1>--}}
                    <h1 style="font-size: 40px !important">  Are you considering a medical procedure?</h1>
                    <h3>   Enhance your knowledge:</h3>
                    <p style="font-size: 18px"> <i class="fa fa-check"></i> Know the critical factors for the decision-making </p>
                    <p style="font-size: 18px"> <i class="fa fa-check"></i> Become updated with evidence based medical practices </p>
                    <p style="font-size: 18px"> <i class="fa fa-check"></i> Be informed of alternative conservative measures, before going under a risky procedure. </p>
{{--                    <a href="{{ url('procedures')}}" class="template-btn mt-3">take appointment</a>--}}

                    <div class="dropdown">
                        <button type="button" class="btn btn-primary dropdown-toggle template-btn mt-3" data-toggle="dropdown">
                            Pick a procedure
                        </button>
                        <div class="dropdown-menu">
                            {{--                        <a class="dropdown-item" onclick="goTo('tonsillectomy')"  >Tonsillectomy</a>--}}
                            {{--                        <a class="dropdown-item" onclick="goTo('knee replacement')"  >Knee Replacement</a>--}}
                            {{--                        <a class="dropdown-item" onclick="goTo('ventilation tubes')"  >Ventilation Tubes</a>--}}
                            <a class="dropdown-item" href="{{ url('procedures/tonsillectomy') }}"  >Tonsillectomy</a>
                            <a class="dropdown-item"  href="{{ url('procedures/knee-replacement') }}"  >Knee Replacement</a>
                            <a class="dropdown-item" href="{{ url('procedures/ventilation-tubes')}} " >Ventilation Tubes</a>
                        </div>
                    </div>






                </div>
            </div>
        </div>

    </section>
@endsection
