@extends('layouts.frontend.app', ['pageTitle' => $pageTitle])
@section('content')
    <style>
        .no-order {
            font-family: 'Crucial' !important;
            font-style: normal;
            font-weight: 500;
            font-size: 36px;
            color: #000000;
        }
    </style>
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
                            @if ($orders->count() == 0)
                                <h1 class="no-order text-center mb-0">No orders yet!</h1>
                            @else
                                <table class="table orders-table mb-0">
                                    <thead>
                                        <tr class="">
                                            <th class="ps-0">Orders</th>
                                            <th>Date</th>
                                            <th>Status</th>
                                            <th>Product Price</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders->unique('order_track_id') as $order)
                                            <tr>
                                                <td class="ps-0 order_track">
                                                    #{{ $order->order_track_id }}
                                                </td>
                                                <td>{{ $order->created_at->format('m:d:Y') }}</td>
                                                <td>
                                                    @if ($order->is_refunded == !null)
                                                        @if ($order->refund->seller_approval == 2)
                                                            Rejected
                                                        @else
                                                            @if ($order->is_refunded == !null)
                                                                Refund {{ ($order->is_refunded == 0 ? 'Pending' : '') . ($order->is_refunded == 1 ? 'In Review' : '') . ($order->is_refunded == 2 ? 'Rejected' : '') . ($order->is_refunded == 3 ? 'Completed' : '') }}
                                                            @else
                                                                {{ ($order->seller_approval == 0 ? 'Pending' : '') . ($order->seller_approval == 1 ? 'Processing' : '') . ($order->seller_approval == 4 ? 'Rejected' : '') }}
                                                            @endif
                                                        @endif
                                                    @else
                                                        @if ($order->seller_approval == 0)
                                                            Pending
                                                        @endif
                                                        @if ($order->seller_approval == 1)
                                                            Processing
                                                        @endif
                                                        @if ($order->seller_approval == 4)
                                                            Rejected
                                                        @endif
                                                        @if ($order->seller_approval == 5)
                                                            On The Way
                                                            <span class="d-none d-lg-inline-block d-xl-inline-block d-xxl-inline-block">|</span>
                                                            <a href="{{ route('my-account.got.the.product', $order->order_track_id) }}" class="refund-link">Got It?</a>
                                                        @endif
                                                        @if ($order->buyer_approval == 1 && $order->seller_approval == 3)
                                                            Completed
                                                        @endif
                                                    @endif
                                                </td>
                                                <td class="text-center">{{ config('currency.usd') . str_replace('.00', '', $order->product->product_price ?? '--') }}</td>
                                                <td class="align-middle">
                                                    @if ($order->seller_approval != 5 && $order->seller_approval != 3)
                                                        @if ($order->is_refunded == !null)
                                                            <a href="javascript:void();" class="text-secondary text-decoration-none {{ $order->refund->seller_approval == 2 ? 'rejectNote' : 'refundedNote' }}">Refund</a>
                                                        @else
                                                            @if ($order->seller_approval == 5)
                                                                <a href="javascript:void();" class="text-secondary text-decoration-none onTheWay">Refund</a>
                                                                <span class="d-none d-lg-inline-block d-xl-inline-block d-xxl-inline-block">|</span>
                                                            @else
                                                                <a href="javascript:void();" id="{{ $order->id }}" class="refund-link" data-bs-toggle="modal" data-bs-target="#order{{ $order->id }}">Refund</a>
                                                                <span class="d-none d-lg-inline-block d-xl-inline-block d-xxl-inline-block">|</span>
                                                            @endif
                                                        @endif
                                                    @else
                                                        {{-- <a href="{{ route('checkout.completed', $order->order_track_id) }}" class="refund-link">Report</a>
                                                    <span class="d-none d-lg-inline-block d-xl-inline-block d-xxl-inline-block">|</span> --}}
                                                    @endif
                                                    <a target="_blank" href="{{ route('checkout.completed', Crypt::encrypt($order)) }}" class="refund-link">Rescript</a>
                                                </td>
                                            </tr>
                                            <div class="modal fade" id="order{{ $order->id }}" tabindex="-1" aria-labelledby="refundModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="refundModalLabel">Refund</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ route('my-account.refund.update', $order->order_track_id) }}" method="POST">
                                                                @csrf
                                                                <div class="input-group">
                                                                    <select name="reason_id" id="" class="form-control">
                                                                        @foreach ($reasons as $reason)
                                                                            <option value="{{ $reason->id }}">{{ $reason->reason }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    <button class="btn btn-success">Submit</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-sm btn-danger" data-bs-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </tbody>
                                </table>
                            @endif
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

@push('js')
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        $('.refundedNote').click(function() {
            swal('Already requested!, Please wait for the confirmation!', '', 'info');
        });
        $('.refundedNote').click(function() {
            swal('Already requested!, Please wait for the confirmation!', '', 'info');
        });
        $('.rejectNote').click(function() {
            swal('Rejected!', 'You can`t refund your product!', 'info');
    });
    $('.onTheWay').click(function() {
        swal('Product is on the way!', 'You can`t refund your product!', 'info');
        });
    </script>
@endpush
