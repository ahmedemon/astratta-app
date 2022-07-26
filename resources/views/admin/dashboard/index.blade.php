@extends('layouts.backend.app', ['pageTitle' => $pageTitle])
@section('content')
    <div class="container-fluid mt-5">
        <h1 class="my-0">Welcome To Dashboard</h1>
        @foreach ($wallets as $key => $wallet)
            <p class="">{{ $wallets_name[$key] }}: {{ config('currency.usd') . $wallet }}</p>
        @endforeach
    </div>
@endsection
