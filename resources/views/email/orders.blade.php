@component('mail::message')

    # Welcome to {{ config('app_name') }}

    Hello {{ $order->user->name ?? $order->user->username }}, Order completed successfully.

    Your order id: #{{ $order->order_track_id }}

@endcomponent
