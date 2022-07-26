@component('mail::message')

    # Welcome to {{ config('app_name') }}

    Hello {{ $seller->username }}
    You have been registered as a seller on {{ config('app_name') }}

    @component('mail::button', ['url' => 'https://arteastratta.es/', 'color' => 'success'])
        Go To Website
    @endcomponent

@endcomponent
