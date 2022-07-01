@extends('layouts.frontend.app', ['pageTitle' => $pageTitle])
@section('content')
    <div class="container-fluid px-0 bg-white" id="custom-breadcrumb">
        <!-- breadcrumb start -->
        <div class="breadcrumb">
            <div class="container d-flex align-items-center px-0">
                <div class="bct">
                    <h1 class="my-0">{{ $pageTitle }}</h1>
                </div>
            </div>
            <svg width="475" height="288" viewBox="0 0 475 288" fill="none" xmlns="http://www.w3.org/2000/svg">
                <g filter="url(#filter0_f_110_1804)">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M117.96 -43.3436C164.674 -53.6429 217.107 -38.8116 250.445 -4.53717C284.977 30.9654 304.906 85.8984 289.387 132.899C275.254 175.704 220.835 183.759 181.174 205.261C154.635 219.65 129.573 232.356 99.5724 235.808C60.0245 240.358 17.2217 251.143 -15.0363 227.837C-52.6431 200.666 -88.9656 153.381 -76.1943 108.819C-63.5742 64.7844 2.06967 70.5434 38.1466 42.2692C70.076 17.2456 78.3263 -34.6054 117.96 -43.3436Z" fill="url(#paint0_linear_110_1804)" />
                </g>
                <defs>
                    <filter id="filter0_f_110_1804" x="-258.803" y="-226.56" width="733.528" height="648.854" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                        <feFlood flood-opacity="0" result="BackgroundImageFix" />
                        <feBlend mode="normal" in="SourceGraphic" in2="BackgroundImageFix" result="shape" />
                        <feGaussianBlur stdDeviation="90" result="effect1_foregroundBlur_110_1804" />
                    </filter>
                    <linearGradient id="paint0_linear_110_1804" x1="-76.0763" y1="83.8635" x2="294.355" y2="108.264" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#FF007D" />
                        <stop offset="1" stop-color="#B627DC" />
                    </linearGradient>
                </defs>
            </svg>
        </div>
        <!-- breadcrumb end -->

        <!-- my account content -->
        <div class="my-account bg-light py96">
            <div class="container px-lg-0 px-xl-0 px-xxl-0">
                <div class="row justify-content-between mx-auto">
                    @include('frontend.my-account.side-menu')
                    <div class="col-md-7 orders-section-width px-lg-0 px-xl-0 px-xxl-0">
                        <div class="orders-section bg-white table-responsive">
                            <div class="row cart-heading">
                                <div class="col-12 d-flex">
                                    <i class="fas fa-user-cog text-danger" style="font-size: 20px"></i>
                                    <p class="my-0 ms-2">Account Settings</p>
                                </div>
                            </div>
                            <div class="row settings mt-5">
                                <form action="{{ route('settings.update', Auth::user()->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="row mb30">
                                        <div class="col-md-12 mb20">
                                            <label for="name" class="label">Name</label>
                                            <input type="text" class="form-control rounded-0 border-0 border-bottom border-secondary shadow-none ps-0 @error('name') is-invalid @enderror" placeholder="John doe" name="name" value="{{ old('name', Auth::user()->name) }}" required />
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <small>{{ $message }}</small>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-12 mb20">
                                            <label for="email" class="label">Email</label>
                                            <input type="text" class="form-control bg-white rounded-0 border-0 border-bottom border-secondary shadow-none ps-0 is-valid" placeholder="Enter email" value="{{ Auth::user()->email }}" required disabled />
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <small>{{ $message }}</small>
                                                </span>
                                            @enderror
                                        </div>
                                        <small class="mb-2 text-secondary">If You don't want to change your password! Just leave this field blank.</small>
                                        <div class="col-md-12 mb20">
                                            <label for="current_password" class="label">Current Password </label>
                                            <input type="password" class="form-control rounded-0 border-0 border-bottom border-secondary shadow-none ps-0 @error('current_password') is-invalid @enderror" placeholder="Enter your current password!" name="current_password" value="{{ old('current_password') }}" />
                                            @error('current_password')
                                                <span class="invalid-feedback" role="alert">
                                                    <small>{{ $message }}</small>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-12 mb20">
                                            <label for="new_password" class="label">New Password</label>
                                            <input type="password" class="form-control rounded-0 border-0 border-bottom border-secondary shadow-none ps-0 @error('new_password') is-invalid @enderror" placeholder="Enter new password!" name="new_password" value="{{ old('new_password') }}" />
                                            @error('new_password')
                                                <span class="invalid-feedback" role="alert">
                                                    <small>{{ $message }}</small>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-12 mb20">
                                            <label for="confirm_password" class="label">Confirm Password</label>
                                            <input type="password" class="form-control rounded-0 border-0 border-bottom border-secondary shadow-none ps-0 @error('confirm_password') is-invalid @enderror" placeholder="Re-enter new password!" name="confirm_password" value="{{ old('confirm_password') }}" />
                                            @error('confirm_password')
                                                <span class="invalid-feedback" role="alert">
                                                    <small>{{ $message }}</small>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <button class="sign-up-button ms-0" type="submit">Send</button>
                                </form>
                            </div>
                        </div>
                        <div class="account-settings bg-white">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="d-flex justify-content-between">
                                        <p class="my-0">Billing Address</p>
                                        <a href="{{ route('billing.edit') }}" class="btn btn-sm btn-outline-success">Edit</a>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex justify-content-between">
                                        <p class="my-0">Shipping Address</p>
                                        <a href="{{ route('shipping.edit') }}" class="btn btn-sm btn-outline-success">Edit</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- my account content -->
    </div>
@endsection
