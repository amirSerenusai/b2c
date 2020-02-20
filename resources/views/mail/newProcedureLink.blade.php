@component('mail::message')
# Introduction

Hello Dear {{auth()->user()->first_name }}, please link on The button bellow to start the case
 {{time()}}

{{--, USER id   {{csrf_token()}}--}}
{{--<div>{{$combinationID}}</div>--}}
<div>$procedure_name  = {{$procedure_name}} </div>
{{--procedures run--}}
{{--@component('mail::button', ['url' => route( 'combination.run', $combinationID  )] )"--}}

@component('mail::button', ['url' => route('link.order' , ['n' => $procedure_name ])] )"

Start Procedure
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
