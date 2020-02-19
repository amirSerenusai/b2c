@component('mail::message')
    {{--# Introduction--}}


    <h2>New Message From Costumer!</h2>
    {{ Carbon\Carbon::now()  }}
{{--    @foreach()--}}
        <div>
{{--            Your password is {{ $user->secret_password }}--}}

        </div>
        {{--@component('mail::button', ['url' => url('/about')])--}}
        About
        @endcomponent

        Thanks,<br>
        {{ config('app.name') }}

