@component('mail::message')
{{--# Introduction--}}


 <h2>Hi {{$user->first_name}} !</h2>
Welcome to SerenusAI !
<div>
    Your password is {{ $user->secret_password }}
</div>
@component('mail::button', ['url' => url('/about')])
About
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
