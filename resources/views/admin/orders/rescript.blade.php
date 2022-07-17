@extends('layouts.frontend.app', ['pageTitle' => $pageTitle])
@section('content')
    <div class="container-fluid px-0 bg-white" id="custom-breadcrumb">
        {{-- <button class="btn btn-sm btn-success" id="save">Save PDF</button> --}}
        <div id="content">
            <div class="rescript bg-white py96">
                <div class="container px-lg-0 px-xl-0 px-xxl-0">
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
                                    <td>#{{ $order->order_track_id }}</td>
                                    <td>{{ $order->order_date }}</td>
                                    <td>{{ $order->user->email ?? '---' }}</td>
                                    <td>{{ config('currency.usd') . $total }}</td>
                                    <td class="text-center">{{ $order->method_id == 1 ? 'Card Payment' : 'Paypal' }}</td>
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
                                    <p class="my-0">Order</p>
                                </div>
                                <div class="col-6 text-end">
                                    <p class="my-0">Price</p>
                                </div>
                            </div>

                            @foreach ($orders as $item)
                                <div class="row cart-body">
                                    <div class="col-8 d-flex align-items-center">
                                        <img class="item-image" src="{{ asset('storage/products/' . $item->product->main_image) }}" alt="" />
                                        <a href="{{ route('painting.show', $item->product_id) }}" class="text-decoration-none color-1">{{ $item->product->product_name ?? '---' }}</a>
                                    </div>
                                    <div class="col-4 d-flex align-items-center justify-content-end">
                                        <p class="my-0 color-1">{{ config('currency.usd') . $item->product->product_price ?? '--' }}</p>
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
                                </div>
                                <div class="described-address">
                                    <p class="my-0">{{ $order->user->billing->first_name ?? '---' }} {{ $order->user->billing->last_name ?? '---' }}</p>
                                    <p class="my-0">{{ $order->user->billing->first_name ?? '---' }}</p>
                                    <p class="my-0">{{ $order->user->billing->street ?? '---' }}</p>
                                    <p class="my-0">{{ $order->user->billing->state ?? '---' }}</p>
                                    <p class="my-0">{{ $order->user->billing->town_city ?? '---' }}</p>
                                    <p class="my-0">{{ $order->user->billing->town_city ?? '---' }}</p>
                                    <p class="my-0">{{ $order->user->billing->post_or_zip ?? '---' }}</p>
                                </div>
                            </div>
                            <div class="col-md-5 address p40">
                                <div class="d-flex justify-content-between align-items-center address-heading mb30">
                                    <p class="my-0">Shipping Address</p>
                                </div>
                                <div class="described-address">
                                    <p class="my-0">{{ $order->user->shipping->first_name ?? '---' }} {{ $order->user->shipping->last_name ?? '---' }}</p>
                                    <p class="my-0">{{ $order->user->shipping->first_name ?? '---' }}</p>
                                    <p class="my-0">{{ $order->user->shipping->street ?? '---' }}</p>
                                    <p class="my-0">{{ $order->user->shipping->state ?? '---' }}</p>
                                    <p class="my-0">{{ $order->user->shipping->town_city ?? '---' }}</p>
                                    <p class="my-0">{{ $order->user->shipping->town_city ?? '---' }}</p>
                                    <p class="my-0">{{ $order->user->shipping->post_or_zip ?? '---' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- shipping billing address -->
                </div>
            </div>
            <!-- ordered item -->
        </div>
    </div>
@endsection
@push('js')
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/dom-to-image/2.6.0/dom-to-image.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.5/jspdf.min.js"></script>

    <script>
        $('#save').click(function() {
            domtoimage.toPng(document.getElementById('content'))
                .then(function(blob) {
                    var pdf = new jsPDF('l', 'pt', [$('#content').width(), $('#content').height()]);

                    pdf.addImage(blob, 'PNG', 0, 0, $('#content').width(), $('#content').height());
                    pdf.save("test.pdf");

                    that.options.api.optionsChanged();
                });
        });
    </script> --}}
@endpush
