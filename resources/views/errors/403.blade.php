@extends('layouts.frontend.app', ['pageTitle' => '403 Forbidden'])
@section('content')
        <div class="container-fluid product-view-page-container not-found-page px-0 d-flex align-items-center">
            <div class="container">
                <div class="content d-grid justify-content-center">
                    <img src="{{ asset('frontend/images/errors/403.png') }}" alt="" />
                    <h1>{{ $exception->getMessage() ?: 'Forbidden' }}</h1>
                    <a href="{{ route('home') }}" class="mx-auto btn rounded-0 shadow-none sign-up-button">Back to home</a>
                </div>
            </div>
        </div>
@endsection
