@extends('layouts.seller.app', ['pageTitle' => $pageTitle])
@section('content')
    <div class="container-fluid px-0 bg-light">
        <div class="container px-lg-0 px-xl-0 px-xxl-0 pt96 pb96 vendor-section">
            <div class="row justify-content-between mx-auto">
                @include('layouts.seller.side-menu')
                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-12 vendor-content">
                    <button class="btn btn-light sideMenuButton d-lg-none d-xl-none d-xxl-none" onclick="sideBarToggle()"><i class="fas fa-arrow-right"></i></button>
                    <div class="row mx-auto">
                        <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-6 mb60">
                            <h3 class="my-0 mb15-i">Orders</h3>
                            <h1 class="my-0">5</h1>
                        </div>
                        <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-6 mb60">
                            <h3 class="my-0 mb15-i">Finished Order</h3>
                            <h1 class="my-0">36</h1>
                        </div>
                        <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-6 mb60">
                            <h3 class="my-0 mb15-i">Sales This Month</h3>
                            <h1 class="my-0">$5,800</h1>
                        </div>
                        <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-6 mb60">
                            <h3 class="my-0 mb15-i">Earning This Month</h3>
                            <h1 class="my-0">$3,800</h1>
                        </div>
                        <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-12 mb30">
                            <h3 class="my-0">Sales</h3>
                        </div>
                        <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 col-12">
                            <div class="chart-area bg-light">
                                <canvas id="myAreaChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
