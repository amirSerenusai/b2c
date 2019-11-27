@component('mail::message')
# Introduction

The body of your message.

@component('mail::button', ['url' => route('procedures.run', $proc_id)] )"
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
