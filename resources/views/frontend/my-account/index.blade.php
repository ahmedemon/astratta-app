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
                            <table class="table orders-table mb-">
                                <thead>
                                    <tr class="">
                                        <th class="ps-0">Orders</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th>Total</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                        <tr>
                                            <td class="ps-0 order_track">
                                                #{{ $order->order_track_id }}
                                            </td>
                                            <td>{{ $order->created_at->format('m:d:Y') }}</td>
                                            <td>{{ $order->status == 1 ? 'Complete' : 'Processing' }}</td>
                                            <td>${{ str_replace('.00', '', $order->product->product_price ?? '--') }}</td>
                                            <td>
                                                <a href="javascript:void();" class="refund-link">Refund</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $orders->links() }}
                        </div>
                        <div class="account-settings bg-white">
                            <a href="{{ route('settings.index') }}" class="account-setting-link">Account Settings</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- my account content -->
    </div>
@endsection
