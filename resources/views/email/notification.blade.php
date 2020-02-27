@component('mail::message')
# Hello {{$name}}

The API will be out of order the next week.

@component('mail::button', ['url' => ''])
Learn More
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
