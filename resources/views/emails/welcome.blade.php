@component('mail::message')
# Hello user,

Welcome to the test mail application

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
