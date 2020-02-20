<div style="margin-bottom: 0; margin-top:-5px;font-size: 1.3em">
    &nbsp;<b id='result'></b> &nbsp;&nbsp; <i id="ok" style="text-align: center;z-index: 100;text-shadow: 12px 12px 3px  greenyellow; font-size: 3.3em;color:green;position: absolute" class="fas fa-check animated d-none "></i></div>
{{--
<button class="btn btn-primary" type="button" disabled>--}} {{-- <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>--}} {{-- <span class="sr-only">Loading...</span>--}} {{--
</button>--}} {{--w-75--}}
<div class="input-group mb-3  mt-2;" >
    <label for="email"></label>
    <input type="email" class="form-control" placeholder="Your Email" id="email">
    <div class="input-group-append">
        <a id="sp-open-a" style="bottom: 373px;margin: 0;padding: 0;
                 right: 228px;">
            <button id="getDecision" data-procedure ="{{ app('request')->input('n')}}" class="template-btn c-pointer animated jello">

                {{--
                <div class="spinner spinner-sending text-white d-inline-block" style=""></div>--}}

                <b style="color:white ; padding:0 ; font-size: 15px">

                    {{--                        <span class="sr-only">Loading...</span>--}}

                    <i class="fa fa-envelope-o" aria-hidden="true"></i>
                    Start process!</b>
            </button>
        </a>
    </div>

</div>

@component('components.pre-loader')@endcomponent
