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

        <!-- rescript -->
        <div class="rescript bg-white pb96">
            <div class="container px-lg-0 px-xl-0 px-xxl-0">
                <p class="my-0 thank-you-greetings pt96">Thank you, your order has been received.</p>
                <div class="table-responsive pt15">
                    <table class="rescript-table table table-sm mb-0">
                        <thead>
                            <tr>
                                <th>Order Number</th>
                                <th>Date</th>
                                <th>Email</th>
                                <th>Total</th>
                                <th>Payment Mehtod</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>#{{ $viewOrder->order_track_id }}</td>
                                <td>{{ $viewOrder->order_date }}</td>
                                <td>{{ $viewOrder->user->email ?? '---' }}</td>
                                <td>${{ $viewOrder->total_cost }}</td>
                                <td>{{ $viewOrder->method_id }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- rescript -->

        <!-- ordered item -->
        <div class="ordered-items">
            <div class="container px-lg-0 px-xl-0 px-xxl-0 px-0">
                <div class="row justify-content-center mx-auto">
                    <div class="col-md-12 bg-white items px-lg-0 px-xl-0 px-xxl-0">
                        <div class="row items-heading">
                            <div class="col-6">
                                <p class="my-0">Your Order</p>
                            </div>
                            <div class="col-6 text-end">
                                <p class="my-0">Price</p>
                            </div>
                        </div>

                        @foreach ($viewOrder->orderItems as $item)
                            @php
                                $image = $item->product->productImages->first() ?? '--';
                            @endphp
                            <div class="row cart-body">
                                <div class="col-8 d-flex align-items-center">
                                    <img class="item-image" src="{{ asset('storage/products/' . $image->image) }}" alt="" />
                                    <a href="{{ route('painting.show', $item->product_id) }}" class="text-decoration-none color-1">{{ $item->product->product_name ?? '---' }}</a>
                                </div>
                                <div class="col-4 d-flex align-items-center justify-content-end">
                                    <p class="my-0 color-1">${{ $item->product->product_price ?? '--' }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- shipping billing address -->
                <div class="container pb96 shipping-billing px-lg-0 px-xl-0 px-xxl-0">
                    <div class="row justify-content-between mx-auto">
                        <div class="col-md-5 address p40">
                            <div class="d-flex justify-content-between align-items-center address-heading mb30">
                                <p class="my-0">Billing Address</p>
                                <a href="javascript::void();" class="">Edit</a>
                            </div>
                            <div class="described-address">
                                <p class="my-0">{{ $viewOrder->billing->first_name ?? '---' }} {{ $viewOrder->billing->last_name ?? '---' }}</p>
                                <p class="my-0">{{ $viewOrder->billing->first_name ?? '---' }}</p>
                                <p class="my-0">{{ $viewOrder->billing->street ?? '---' }}</p>
                                <p class="my-0">{{ $viewOrder->billing->state ?? '---' }}</p>
                                <p class="my-0">{{ $viewOrder->billing->town_city ?? '---' }}</p>
                                <p class="my-0">{{ $viewOrder->billing->town_city ?? '---' }}</p>
                                <p class="my-0">{{ $viewOrder->billing->post_or_zip ?? '---' }}</p>
                            </div>
                        </div>
                        <div class="col-md-5 address p40">
                            <div class="d-flex justify-content-between align-items-center address-heading mb30">
                                <p class="my-0">Shipping Address</p>
                                <a href="javascript::void();" class="">Edit</a>
                            </div>
                            <div class="described-address">
                                <p class="my-0">{{ $viewOrder->shipping->first_name ?? '---' }} {{ $viewOrder->shipping->last_name ?? '---' }}</p>
                                <p class="my-0">{{ $viewOrder->shipping->first_name ?? '---' }}</p>
                                <p class="my-0">{{ $viewOrder->shipping->street ?? '---' }}</p>
                                <p class="my-0">{{ $viewOrder->shipping->state ?? '---' }}</p>
                                <p class="my-0">{{ $viewOrder->shipping->town_city ?? '---' }}</p>
                                <p class="my-0">{{ $viewOrder->shipping->town_city ?? '---' }}</p>
                                <p class="my-0">{{ $viewOrder->shipping->post_or_zip ?? '---' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- shipping billing address -->
            </div>
        </div>
        <!-- ordered item -->
    </div>
@endsection
