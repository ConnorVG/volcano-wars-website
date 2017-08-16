@component('mail::message')
# Welcome to {{ config('app.name') }}!

Thanks,<br>
{{ $application->name }}
@endcomponent
