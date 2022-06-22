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
                    <div class="col-md-3 profile-section bg-white">
                        <div class="profile-info-section">
                            <h1 class="my-0 mb40-important">Hello {{ strtok(Auth::user()->name, ' ') }},</h1>
                            <p class="my-0 mb10-important">4:14PM</p>
                            <p class="my-0 mb40-important">May 27, 2022</p>
                            <a href="{{ route('logout') }}" class="btn rounded-0 sign-in-button logout mb45" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                        <hr class="mb50-important" />
                        <div class="row mx-auto profile-product-section">
                            <div class="col-md-12 d-flex align-items-center px-lg-0 px-xl-0 px-xxl-0 mb40">
                                <img src="{{ asset('frontend/images/art/demo3.png') }}" alt="" />
                                <a href="{{ route('painting.show', 1) }}" class="">La Réunion Acryilic</a>
                            </div>
                            <div class="col-md-12 d-flex align-items-center px-lg-0 px-xl-0 px-xxl-0">
                                <img src="{{ asset('frontend/images/art/demo3.png') }}" alt="" />
                                <a href="{{ route('painting.show', 1) }}" class="">La Réunion Acryilic</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7 orders-section-width px-lg-0 px-xl-0 px-xxl-0">
                        <div class="orders-section bg-white table-responsive">
                            <table class="table orders-table mb-0">
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
                                    <tr>
                                        <td class="ps-0">#265</td>
                                        <td>May 27, 2022</td>
                                        <td>Processing</td>
                                        <td>$10,256</td>
                                        <td><a href="javascript:void();" class="refund-link">Refund</a></td>
                                    </tr>
                                    <tr>
                                        <td class="ps-0">#453</td>
                                        <td>January 3, 2022</td>
                                        <td>Processing</td>
                                        <td>$1,200</td>
                                        <td><a href="javascript:void();" class="refund-link">Refund</a></td>
                                    </tr>
                                    <tr>
                                        <td class="ps-0">#412</td>
                                        <td>January 3, 2022</td>
                                        <td>Processing</td>
                                        <td>$6,530</td>
                                        <td><a href="javascript:void();" class="refund-link">Refund</a></td>
                                    </tr>
                                    <tr>
                                        <td class="ps-0">#354</td>
                                        <td>January 3, 2022</td>
                                        <td>Completed</td>
                                        <td>$400</td>
                                        <td><a href="javascript:void();" class="refund-link">Refund</a></td>
                                    </tr>
                                    <tr>
                                        <td class="ps-0">#587</td>
                                        <td>January 3, 2022</td>
                                        <td>Completed</td>
                                        <td>$680</td>
                                        <td><a href="javascript:void();" class="refund-link">Refund</a></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="account-settings bg-white">
                            <a href="javascript:void();" class="account-setting-link">Account Settings</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- my account content -->
    </div>
@endsection
