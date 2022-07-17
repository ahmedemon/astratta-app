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

        <form action="{{ route('checkout.checkout') }}" method="POST">
            @csrf
            @method('GET')
            <!-- product list -->
            <div class="cart-product-list bg-light">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-8 bg-white cart">
                            <div class="row cart-heading">
                                <div class="col-6">
                                    <p class="my-0">Painting</p>
                                </div>
                                <div class="col-6 text-end">
                                    <p class="my-0">Price</p>
                                </div>
                            </div>
                            @foreach ($cartItems as $item)
                                <label for="chk-{{ $item->id }}" class="row-label">
                                    <div class="row cart-body" id="row-{{ $item->id }}">
                                        <input type="hidden" name="items[{{ $item->id }}][cart_item_id]" value="{{ $item->id }}" />
                                        <input class="input-x d-none" type="checkbox" checked id="chk-{{ $item->id }}" name="items[{{ $item->id }}][product_id]" value="{{ $item->product_id }}" data-price="{{ $item->product->product_price }}" required aria-required="" />
                                        <div class="col-8 d-flex align-items-center">
                                            <a href="{{ route('my-cart.remove-from-cart', $item->id) }}" class="m-0">
                                                <i class="lni lni-close" id="close-{{ $item->id }}"></i>
                                            </a>
                                            <img class="product-image" src="{{ asset('storage/products/' . $item->product->main_image) }}" alt="" />
                                            <a href="{{ route('painting.show', $item->product_id) }}" class="text-decoration-none color-{{ $item->id }}">{{ $item->product->product_name }}</a>
                                        </div>
                                        <div class="col-4 d-flex align-items-center justify-content-end">
                                            <p class="my-0 color-{{ $item->id }}">${{ str_replace('.00', '', $item->product->product_price) }}</p>
                                        </div>
                                    </div>
                                </label>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <!-- product list -->

            <!-- apply coupon -->
            <div class="apply-coupon bg-light">
                <div class="container px-lg-0 px-xl-0 px-xxl-0">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="coupon-body bg-white d-flex">
                                <input type="text" name="code" id="code" class="form-control rounded-0 shadow-none" placeholder="Coupon Code" />
                                <button class="btn rounded-0 sign-in-button" type="button" id="discountButton">Apply Coupon</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- apply coupon -->

            <!-- cart total -->
            <div class="cart-total bg-light">
                <div class="container px-lg-0 px-xl-0 px-xxl-0">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="cart-total-body bg-white">
                                <h3 class="my-0">Cart Total</h3>
                                <div class="d-flex subtotal justify-content-between mb25">
                                    <p class="my-0 subtotal-title">Subtotal</p>
                                    <p class="my-0 subtotal-amount">{{ config('currency.usd') }}</p>
                                </div>
                                <div class="d-flex discounted justify-content-between mb25">
                                    <p class="my-0 discounted-title">Discounted</p>
                                    <p class="my-0 discounted-amount">{{ config('symbol.percent') }}0</p>
                                </div>
                                <hr class="mb25" />
                                <div class="d-flex shipping justify-content-between mb25">
                                    <p class="my-0 shipping-title">Total</p>
                                    <p class="my-0 shipping-amount d-flex align-items-center justify-content-end">
                                        {{ config('currency.usd') }}
                                        <input class="bg-transparent px-0 border-0 text-end form-control rounded-0 shadow-none w-50" id="total" type="number" name="total_cost" min="1" value="" readonly />
                                    </p>
                                </div>

                                <button class="d-flex align-items-center justify-content-center w-100 btn rounded-0 border-0 sign-up-button checkout-button">Proceed To Checkout</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- cart total -->
        </form>
    </div>
    <div id="tots"></div>
@endsection

@push('js')
    <script>
        $("input[type=checkbox]").on("change", function() {
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
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        // for checking all product is selected
        $(".checkout-button").click(function(e) {
            var allCheckBox = $("[id^='chk-']")
            var count_checked = allCheckBox.filter(":checked").length;
            if (count_checked == 0) {
                swal("Please select product!", "", "info");
                e.preventDefault();
            } else if (count_checked != allCheckBox.length) {
                swal("Some product is not selected!", "", "warning");
                e.preventDefault();
            }
        });
        // for checking all product is selected

        // calculate price
        function calc() {
            var tots = 0;
            $(".input-x:checked").each(function() {
                var price = $(this).attr("data-price");
                tots += parseFloat(price);
            });
            var total = tots;

            document.getElementById("discountButton").addEventListener("click", addDiscount);

            function addDiscount() {
                var couponCode = document.getElementById('code');
                var coupon = couponCode.value;

                $.ajax({
                    url: "{{ route('my-cart.check.coupon') }}",
                    method: "GET",
                    data: {
                        code: coupon,
                    },
                    success: function(response) {
                        if (response == 1) {
                            swal('Success!', 'Coupon Accepted!', 'success');
                            document.getElementsByClassName("discounted-amount")[0].innerHTML = "%" + 10;
                            $('#code').attr('readonly', '');
                            $('#discountButton').attr('disabled', '');
                        } else {
                            swal({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Coupon not Accepted!'
                            });
                        }
                    }
                });
            };

            document.getElementById("total").value = total; // .toFixed(2) 2 is for .00
            document.getElementsByClassName("subtotal-amount")[0].innerHTML = ("{{ config('currency.usd') }}" + tots.toFixed(2));

        }
        $(function() {
            $(document).on("change", ".input-x", calc);
            calc();
        });
        // calculate price
    </script>
@endpush
