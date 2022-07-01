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
                    <div class="col-md-7 px-lg-0 px-xl-0 px-xxl-0">
                        <form action="{{ route('billing.update', $billing->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row justify-content-center">
                                <div class="col-md-12 bg-white p-5">
                                    <h3 class="my-0 mb35">Billing Detials</h3>
                                    @if (count($errors) > 0)
                                        @foreach ($errors->all() as $error)
                                            <small class="text-danger">{{ $error }}</small>
                                        @endforeach
                                    @endif
                                    <div class="row justify-content-between">
                                        <div class="col-md-6 mb30">
                                            <label for="first_name">First Name</label>
                                            <input id="first_name" name="first_name" value="{{ $billing->first_name }}" type="text" class="form-control border-0 border-bottom border-secondary rounded-0 shadow-none px-0 pb-1 pt-0" placeholder="John Doe" />
                                            @error('first_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <small>{{ $message }}</small>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 mb30">
                                            <label for="last_name">Last Name</label>
                                            <input id="last_name" name="last_name" value="{{ $billing->last_name }}" type="text" class="form-control border-0 border-bottom border-secondary rounded-0 shadow-none px-0 pb-1 pt-0" placeholder="John Doe" />
                                            @error('last_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <small>{{ $message }}</small>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 mb30">
                                            <label for="phone">Phone</label>
                                            <input id="phone" name="phone" value="{{ $billing->phone ?? '' }}" type="tel" class="form-control border-0 border-bottom border-secondary rounded-0 shadow-none px-0 pb-1 pt-0" placeholder="John Doe" />
                                            @error('phone')
                                                <span class="invalid-feedback" role="alert">
                                                    <small>{{ $message }}</small>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 mb30">
                                            <label for="email">Email</label>
                                            <input id="email" name="email" value="{{ $billing->email ?? '' }}" type="email" class="form-control border-0 border-bottom border-secondary rounded-0 shadow-none px-0 pb-1 pt-0" placeholder="John Doe" />
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <small>{{ $message }}</small>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 mb30">
                                            <label for="country">Country</label>
                                            <input id="country" name="country" value="{{ $billing->country ?? '' }}" type="text" class="form-control border-0 border-bottom border-secondary rounded-0 shadow-none px-0 pb-1 pt-0" placeholder="John Doe" />
                                            @error('country')
                                                <span class="invalid-feedback" role="alert">
                                                    <small>{{ $message }}</small>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 mb30">
                                            <label for="state">State</label>
                                            <input id="state" name="state" value="{{ $billing->state ?? '' }}" type="text" class="form-control border-0 border-bottom border-secondary rounded-0 shadow-none px-0 pb-1 pt-0" placeholder="John Doe" />
                                            @error('state')
                                                <span class="invalid-feedback" role="alert">
                                                    <small>{{ $message }}</small>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 mb30">
                                            <label for="town_city">Town / City</label>
                                            <input id="town_city" name="town_city" value="{{ $billing->town_city ?? '' }}" type="text" class="form-control border-0 border-bottom border-secondary rounded-0 shadow-none px-0 pb-1 pt-0" placeholder="John Doe" />
                                            @error('town_city')
                                                <span class="invalid-feedback" role="alert">
                                                    <small>{{ $message }}</small>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 mb30">
                                            <label for="street">Street Address</label>
                                            <input id="street" name="street" value="{{ $billing->street ?? '' }}" type="text" class="form-control border-0 border-bottom border-secondary rounded-0 shadow-none px-0 pb-1 pt-0" placeholder="John Doe" />
                                            @error('street')
                                                <span class="invalid-feedback" role="alert">
                                                    <small>{{ $message }}</small>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 mb30">
                                            <label for="post_or_zip">Postcode / ZIP (Optional)</label>
                                            <input id="post_or_zip" name="post_or_zip" value="{{ $billing->post_or_zip ?? '' }}" type="text" class="form-control border-0 border-bottom border-secondary rounded-0 shadow-none px-0 pb-1 pt-0" placeholder="John Doe" />
                                            @error('post_or_zip')
                                                <span class="invalid-feedback" role="alert">
                                                    <small>{{ $message }}</small>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="d-flex justify-content-end">
                                            <button class="sign-up-button ms-0 w-100" type="submit">Save Changes</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- my account content -->
    </div>
@endsection
