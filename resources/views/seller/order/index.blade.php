@extends('layouts.seller.app', ['pageTitle' => $pageTitle])
@section('content')
    <style>
        .refund-link {
            text-decoration: none;
            font-family: 'Crucial' !important;
            font-style: normal;
            font-weight: 500;
            font-size: 16px;
            line-height: 21px;
            color: #CE4899 !important;
        }
    </style>
    <div class="container-fluid px-0 bg-light">
        <div class="container px-lg-0 px-xl-0 px-xxl-0 pt96 pb96 vendor-section">
            <div class="row justify-content-between mx-auto">
                @include('layouts.seller.side-menu')
                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-12 vendor-content">
                    {{-- <button class="btn btn-light sideMenuButton d-lg-none d-xl-none d-xxl-none" onclick="sideBarToggle()"><i class="fas fa-arrow-right"></i></button> --}}
                    <h1 class="my-0 text-center border-bottom mb35-i">{{ $pageTitle }}</h1>
                    <table class="table table-borderless" style="width: 100%">
                        <thead class="mb30-i">
                            <tr>
                                <th class="align-middle active">Product</th>
                                <th class="align-middle active">Order Id</th>
                                <th class="align-middle active text-center">Status</th>
                                <th class="align-middle active text-center">Date</th>
                                <th class="align-middle active text-center">Total</th>
                                <th class="align-middle active text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders->unique('order_track_id') as $order)
                                <tr class="data-row">
                                    <td class="align-middle" width="50%">
                                        <div class="py15 d-flex align-items-center">
                                            <div class="action-buttons d-flex">
                                                @if ($order->seller_approval == 0)
                                                    <a href="{{ route('seller.orders.approve', $order->id) }}" class="text-decoration-none d-flex align-items-center text-info mx-2">
                                                        <i class="fas fa-check"></i>
                                                    </a>
                                                    <a href="{{ route('seller.orders.reject', $order->id) }}" class="text-decoration-none d-flex align-items-center text-danger mx-2">
                                                        <i class="fas fa-times"></i>
                                                    </a>
                                                @else
                                                    @if ($order->seller_approval == 2)
                                                        <a href="{{ route('seller.orders.make.delete', $order->id) }}" class="text-decoration-none d-flex align-items-center text-danger mx-2" onclick="return confirm('Are you sure you want to delete?');">
                                                            <i class="fas fa-times"></i>
                                                        </a>
                                                    @else
                                                        @if ($order->seller_approval == 5)
                                                            <a href="{{ route('seller.orders.make.delete', $order->id) }}" class="text-decoration-none d-flex align-items-center text-danger mx-2" onclick="return confirm('Are you sure you want to delete?');">
                                                                <i class="fas fa-times"></i>
                                                            </a>
                                                        @else
                                                            @if ($order->seller_approval != 3)
                                                                <a href="{{ route('seller.orders.sent', $order->id) }}" class="text-decoration-none d-flex align-items-center text-success mx-2" onclick="return confirm('Are you sure you want to send?');">
                                                                    <i class="fas">Sent</i>
                                                                </a>
                                                            @else
                                                                <a href="{{ route('seller.orders.make.delete', $order->id) }}" class="text-decoration-none d-flex align-items-center text-danger mx-2" onclick="return confirm('Are you sure you want to delete?');">
                                                                    <i class="fas fa-times"></i>
                                                                </a>
                                                            @endif
                                                        @endif
                                                    @endif
                                                @endif
                                            </div>
                                            <img src="{{ asset('storage/products/' . $order->product->main_image) }}" alt="" />
                                            <a href="{{ route('painting.show', $order->product->id) }}" class="ml20">{{ $order->product->product_name ?? '---' }}</a>
                                        </div>
                                    </td>
                                    <td class="align-middle">#{{ $order->order_track_id }}</td>
                                    <td class="align-middle text-center">
                                        @if ($order->seller_approval == 0)
                                            <span class="text-warning">Pending</span>
                                        @else
                                            @if ($order->status == 0)
                                                @if ($order->seller_approval == 1)
                                                    <span class="text-info">In Review</span>
                                                @else
                                                    <span class="text-danger">Rejected</span>
                                                @endif
                                            @else
                                                @if ($order->seller_approval == 2)
                                                    <span class="text-danger">Rejected</span>
                                                @else
                                                    @if ($order->seller_approval == 5)
                                                        <span class="text-success">Sending</span>
                                                    @else
                                                        @if ($order->seller_approval != 3)
                                                            <span class="text-{{ ($order->status == 1 ? 'warning' : '') . ($order->status == 2 ? 'success' : '') . ($order->status == 3 ? 'danger' : '') }}">
                                                                {{ ($order->status == 1 ? 'Processing' : '') . ($order->status == 2 ? 'Complete' : '') . ($order->status == 3 ? 'Rejected' : '') }}
                                                            </span>
                                                        @endif
                                                    @endif
                                                @endif
                                            @endif
                                        @endif
                                        @if ($order->seller_approval == 3)
                                            <span class="text-success">Completed</span>
                                        @endif
                                    </td>
                                    <td class="align-middle text-center">{{ $order->product->created_at->format('M:d:Y') }}</td>
                                    <td class="align-middle text-center">${{ str_replace('.00', '', $order->total_cost ?? '---') }}</td>
                                    <td class="align-middle text-center"><a target="_blank" href="{{ route('checkout.completed', Crypt::encrypt($order)) }}" class="refund-link">Rescript</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $orders->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        $(".data-row").on("::focus-visible", function() {
            var $chk = $(this),
                num = $chk.attr("id").substring(4),
                $row = $("#row-" + num),
                $closeBtn = $("#close-" + num),
                $colorChnage = $(".color-" + num);

            $row.toggleClass("ps-1 bg-danger");
            $closeBtn.toggleClass("close-button-font");
            $colorChnage.toggleClass("text-white-selected");
        });
    </script>
@endpush
