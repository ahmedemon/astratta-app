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
                                <th class="align-middle active">Order Id</th>
                                <th class="align-middle active text-center">Qty</th>
                                <th class="align-middle active text-center">Status</th>
                                <th class="align-middle active text-center">Date</th>
                                <th class="align-middle active text-center">Price</th>
                                <th class="align-middle active text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders->unique('order_track_id') as $order)
                                @php
                                    $id = Crypt::encrypt($order);
                                @endphp
                                <tr class="data-row">
                                    <td class="align-middle">#{{ $order->order_track_id }}</td>
                                    <td class="align-middle text-center">{{ $count }} Items</td>
                                    <td class="align-middle text-center">
                                        @if ($order->refund->status == 0)
                                            @if ($order->refund->seller_approval == 2)
                                                <span class="text-danger">Rejected</span>
                                            @else
                                                <span class="text-warning">Pending</span>
                                            @endif
                                        @else
                                            @if ($order->refund->status == 0)
                                                @if ($order->refund->status == 1)
                                                    <span class="text-info">In Review</span>
                                                @else
                                                    <span class="text-danger">Rejected</span>
                                                @endif
                                            @else
                                                @if ($order->refund->status == 2)
                                                    <span class="text-danger">Rejected</span>
                                                @else
                                                    <span class="text-{{ ($order->refund->status == 1 ? 'warning' : '') . ($order->refund->status == 2 ? 'danger' : '') . ($order->refund->status == 3 ? 'info' : '') }}">
                                                        {{ ($order->refund->status == 1 ? 'Processing' : '') . ($order->refund->status == 2 ? 'Rejected' : '') . ($order->refund->status == 3 ? 'Completed' : '') }}
                                                    </span>
                                                @endif
                                            @endif
                                        @endif
                                    </td>
                                    <td class="align-middle text-center">{{ $order->product->created_at->format('M:d:Y') }}</td>
                                    <td class="align-middle text-center">{{ '$' . str_replace('.00', '', $order->total_cost ?? '---') }}</td>
                                    <td class="align-middle text-center">
                                        <div class="py15 d-flex align-items-between justify-content-between">
                                            <a target="_blank" href="{{ route('checkout.completed', $id) }}" class="refund-link">Rescript</a>
                                            <div class="d-flex">
                                                @if ($order->refund->seller_approval == 0)
                                                    <a href="{{ route('seller.refund.approve', $order->id) }}" class="text-decoration-none d-flex align-items-center text-info mx-2">
                                                        <i class="fas fa-check"></i>
                                                    </a>
                                                    <a href="{{ route('seller.refund.reject', $order->id) }}" class="text-decoration-none d-flex align-items-center text-danger mx-2">
                                                        <i class="fas fa-times"></i>
                                                    </a>
                                                @else
                                                    <a href="javascript:void();" class="text-decoration-none d-flex align-items-center text-danger mx-2">
                                                    </a>
                                                    @if ($order->refund->seller_approval == 2)
                                                        <a href="{{ route('seller.refund.destroy', $order->id) }}" class="text-decoration-none d-flex align-items-center text-danger mx-2" onclick="return confirm('Are you sure you want to delete?');">
                                                            <i class="fas fa-times"></i>
                                                        </a>
                                                    @else
                                                        <a href="{{ route('seller.refund.make.delete', $order->id) }}" class="text-decoration-none d-flex align-items-center text-danger mx-2" onclick="return confirm('Are you sure you want to delete?');">
                                                            <i class="fas fa-times"></i>
                                                        </a>
                                                    @endif
                                                @endif
                                            </div>
                                        </div>
                                    </td>
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
