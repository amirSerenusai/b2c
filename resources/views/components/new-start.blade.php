
{{--<button class="btn btn-primary" type="button" disabled>--}}
{{--    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>--}}
{{--    <span class="sr-only">Loading...</span>--}}
{{--</button>--}}
    <div class="input-group mb-3 w-75 mt-4">
        <label for="email"></label><input type="email" class="form-control" placeholder="Your Email" style="height: 50px" id="email">
        <div class="input-group-append">
            <a  id="sp-open-a" style="
    bottom: 373px;margin: 0;padding: 0;
    right: 228px;"><button id="getDecision"  class="template-btn  c-pointer"  >

{{--                        <div class="spinner spinner-sending text-white d-inline-block" style=""></div>--}}

                    <b style="color:white ; padding:0 ; font-size: 15px">

{{--                        <span class="sr-only">Loading...</span>--}}

                        <i class="fa fa-envelope-o" aria-hidden="true"></i>
                        Start process!</b>
                </button></a>
        </div>
    </div>

    <h4 id='result'></h4>

        @component('components.pre-loader')@endcomponent



