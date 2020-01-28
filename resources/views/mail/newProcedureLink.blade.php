@component('mail::message')
# Introduction

Hello Dear User, please link on The button bellow to start the case
 {{time()}} , USER id   {{csrf_token()}}
<div>{{$combinationID}}</div>
{{--procedures run--}}
{{--@component('mail::button', ['url' => route( 'combination.run', $combinationID  )] )"--}}

@component('mail::button', ['url' => route('link.order')] )"

Start Procedure
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
