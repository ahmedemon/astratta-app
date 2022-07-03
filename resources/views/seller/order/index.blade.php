@extends('layouts.seller.app', ['pageTitle' => $pageTitle])
@section('content')
    <div class="container-fluid px-0 bg-light">
        <div class="container px-lg-0 px-xl-0 px-xxl-0 pt96 pb96 vendor-section">
            <div class="row justify-content-between mx-auto">
                @include('layouts.seller.side-menu')
                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-12 vendor-content">
                    <button class="btn btn-light sideMenuButton d-lg-none d-xl-none d-xxl-none" onclick="sideBarToggle()"><i class="fas fa-arrow-right"></i></button>
                    <h1 class="my-0 text-center border-bottom mb35-i">{{ $pageTitle }}</h1>
                    <table class="table table-borderless" style="width: 100%">
                        <thead class="mb30-i">
                            <tr>
                                <th class="align-middle active">Product</th>
                                <th class="align-middle active">Order Id</th>
                                <th class="align-middle active text-center">Status</th>
                                <th class="align-middle active text-center">Date</th>
                                <th class="align-middle active text-center">Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                <tr class="data-row">
                                    <td class="align-middle" width="50%">
                                        <div class="py15 d-flex align-items-center">
                                            <div class="action-buttons d-flex">
                                                <a href="javascript::void();" class="text-decoration-none d-flex align-items-center text-info mx-2">
                                                    <i class="fas fa-check"></i>
                                                </a>
                                            </div>
                                            <img src="{{ asset('storage/products/' . $order->product->main_image) }}" alt="" />
                                            <a href="{{ route('painting.show', $order->product->id) }}" class="ml20">{{ $order->product->product_name ?? '---' }}</a>
                                        </div>
                                    </td>
                                    <td class="align-middle">#{{ $order->order_track_id }}</td>
                                    <td class="align-middle text-center">
                                        {{ ($order->status == 0 ? 'Processing' : '') . ($order->status == 1 ? 'Processing' : '') . ($order->status == 2 ? 'Complete' : '') . ($order->status == 3 ? 'Rejected' : '') }}
                                    </td>
                                    <td class="align-middle text-center">{{ $order->product->created_at->format('M:d:Y') }}</td>
                                    <td class="align-middle text-center">${{ str_replace('.00', '', $order->product->product_price ?? '---') }}</td>
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
