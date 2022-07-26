@extends('layouts.seller.app', ['pageTitle' => $pageTitle])
@section('content')
    <style>
        h5 {
            font-family: 'Crucial' !important;
            font-style: normal;
            font-weight: 500;
            color: #000000;
        }
    </style>
    <div class="container-fluid px-0 bg-light">
        <div class="container px-lg-0 px-xl-0 px-xxl-0 pt96 pb96 vendor-section">
            <div class="row justify-content-between mx-auto">
                @include('layouts.seller.side-menu')
                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-12 vendor-content">
                    {{-- <button class="btn btn-light sideMenuButton d-lg-none d-xl-none d-xxl-none" onclick="sideBarToggle()"><i class="fas fa-arrow-right"></i></button> --}}
                    <div class="card-body d-flex align-items-center justify-content-between mb30 pb10 border-bottom">
                        <h3 class="my-0">{{ $pageTitle }}</h3>
                        <a href="{{ route('seller.withdraw.index') }}" class="btn btn-sm rounded-0 pb-0 sign-in-button mx-0 h-50">Go Back</a>
                    </div>
                    @if (count($errors) > 0)
                        @foreach ($errors->all() as $error)
                            <small class="text-danger">{{ $error }}</small>
                        @endforeach
                    @endif
                    <form action="{{ route('seller.withdraw.put.method') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row justify-content-center">
                            <div class="col-md-10">
                                <div class="row justify-content-center">
                                    <p class="mt70">Note: If you want only one method then leave blank another.</p>
                                    <div class="col-md-6">
                                        <div class="mb20">
                                            <label for="stripe">
                                                <h5>Stripe Account</h5>
                                            </label>
                                            <input type="text" name="stripe_id" class="form-control" placeholder="Enter stripe id" value="{{ old('stripe_id', $seller->stripe_id) }}">
                                            @error('stripe_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <small>{{ $message }}</small>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb20">
                                            <label for="paypal">
                                                <h5>Paypal Account</h5>
                                            </label>
                                            <input type="text" name="paypal_id" class="form-control" placeholder="Enter paypal id" value="{{ old('paypal_id', $seller->paypal_id) }}">
                                            @error('paypal_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <small>{{ $message }}</small>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb20">
                                            <label for="paypal">
                                                <h5>Password</h5>
                                            </label>
                                            <input type="password" name="password" class="form-control" placeholder="Enter password to save chnages" required>
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <small>{{ $message }}</small>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb20">
                                            <label class="mb10" for="paypal">
                                                &nbsp;
                                            </label>
                                            <button class="sign-up-button btn-block w-100">Save Changes</button>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <hr>
                                        <p>Note: If you don't have any account of these then create a account first.</p>
                                        <a href="https://www.stripe.com" target="_blank" class="text-decoration-none btn p-0">
                                            <img src="{{ asset('vendor/stripe.png') }}" alt="" height="50px">
                                        </a>
                                        <a href="https://www.paypal.com" target="_blank" class="text-decoration-none btn btn-outline-info p-0">
                                            <img src="{{ asset('vendor/paypal.png') }}" alt="" height="50px">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        function yesnoCheck(that) {
            if (that.value == "1") {
                document.getElementById("1").className = "mb20 d-block";
            } else {
                document.getElementById("1").className = "mb20 d-none";
            }
            if (that.value == "2") {
                document.getElementById("2").className = "mb20 d-block";
            } else {
                document.getElementById("2").className = "mb20 d-none";
            }
        }
    </script>
@endpush
