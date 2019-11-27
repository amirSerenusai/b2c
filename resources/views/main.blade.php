@extends ('layout')
@section ('content')
    <section class="banner-area" style="background-color: rgba(0,0,0,0)">
        <div class="container">
            <div class="row">
                <div class="col-lg-5">

                    <h4>Caring for better life</h4>
                    <h1>Leading the way in medical excellence</h1>
                    <p>Earth greater grass for good. Place for divide evening yielding them that. Creeping beginning over gathered brought.</p>
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
