@component('mail::message')
    # Розсилка

    {{ $text }}


    Thanks,<br>
    {{ config('app.name') }}
@endcomponent
