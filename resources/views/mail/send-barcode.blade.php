@component('mail::message')
Hello,

@component('mail::panel')
{{ $content }}
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
