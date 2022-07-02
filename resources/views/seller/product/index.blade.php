@extends('layouts.seller.app', ['pageTitle' => $pageTitle])
@section('content')
    <div class="container-fluid px-0 bg-light">
        <div class="container px-lg-0 px-xl-0 px-xxl-0 pt96 pb96 vendor-section">
            <div class="row justify-content-between mx-auto">
                @include('layouts.seller.side-menu')
                <div class="col-md-8 col-lg-8 col-xl-8 col-xxl-8 col-12 vendor-content">
                    <button class="btn btn-light sideMenuButton d-lg-none d-xl-none d-xxl-none" onclick="sideBarToggle()"><i class="fas fa-arrow-right"></i></button>
                    <div class="card mb30 border-0">
                        <div class="card-body d-flex align-items-center justify-content-between">
                            <h3 class="my-0">Products</h3>
                            <a href="{{ route('seller.product.create') }}" class="btn btn-sm rounded-0 pb-0 sign-in-button mx-0 h-50">Add New</a>
                        </div>
                    </div>
                    <table class="table table-borderless" style="width: 100%">
                        <thead class="mb30-i">
                            <tr>
                                <th class="align-middle active">Product</th>
                                <th class="align-middle active text-center">Status</th>
                                <th class="align-middle active text-center">Date</th>
                                <th class="align-middle active text-center">Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr class="data-row">
                                    <td class="align-middle" width="50%">
                                        <div class="py15 d-flex align-items-center">
                                            <div class="action-buttons d-flex">
                                                <a href="{{ route('seller.product.destroy', $product->id) }}" class="text-decoration-none d-flex align-items-center text-danger mx-2">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                                <a href="{{ route('seller.product.edit', $product->id) }}" class="text-decoration-none d-flex align-items-center text-info mx-2">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                            </div>
                                            <img src="{{ asset('storage/products/' . $product->main_image) }}" alt="" />
                                            <a href="{{ route('painting.show', $product->id) }}" class="ml20">{{ $product->product_name }}</a>
                                        </div>
                                    </td>
                                    <td class="align-middle text-center">
                                        {{ ($product->status == 0 ? 'Processing' : '') . ($product->status == 1 ? 'Processing' : '') . ($product->status == 2 ? 'Complete' : '') . ($product->status == 3 ? 'Rejected' : '') }}
                                    </td>
                                    <td class="align-middle text-center">{{ $product->created_at->format('m:d:Y') }}</td>
                                    <td class="align-middle text-center">${{ str_replace('.00', '', $product->product_price) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $products->links() }}
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
