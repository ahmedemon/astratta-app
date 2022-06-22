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

        <form action="" method="POST">
            @csrf
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
                            <label for="chk-1" class="row-label">
                                <div class="row cart-body" id="row-1">
                                    <input class="input-x d-none" type="checkbox" id="chk-1" value="5" data-price="400" />
                                    <div class="col-8 d-flex align-items-center">
                                        <i class="lni lni-close" id="close-1"></i>
                                        <img class="product-image" src="{{ asset('frontend/images/art/demo3.png') }}" alt="" />
                                        <a class="text-decoration-none color-1">La Réunion Acryilic</a>
                                    </div>
                                    <div class="col-4 d-flex align-items-center justify-content-end">
                                        <p class="my-0 color-1">$400</p>
                                    </div>
                                </div>
                            </label>
                            <label for="chk-2" class="row-label">
                                <div class="row cart-body" id="row-2">
                                    <input class="input-x d-none" type="checkbox" id="chk-2" value="5" data-price="1200" />
                                    <div class="col-8 d-flex align-items-center">
                                        <i class="lni lni-close" id="close-2"></i>
                                        <img class="product-image" src="{{ asset('frontend/images/art/art2.png') }}" alt="" />
                                        <a class="text-decoration-none color-2">Newborn Acryilic</a>
                                    </div>
                                    <div class="col-4 d-flex align-items-center justify-content-end">
                                        <p class="my-0 color-2">$1,200</p>
                                    </div>
                                </div>
                            </label>
                            <label for="chk-3" class="row-label">
                                <div class="row cart-body" id="row-3">
                                    <input class="input-x d-none" type="checkbox" id="chk-3" value="5" data-price="1000" />
                                    <div class="col-8 d-flex align-items-center">
                                        <i class="lni lni-close" id="close-3"></i>
                                        <img class="product-image" src="{{ asset('frontend/images/footer1.png') }}" alt="" />
                                        <a class="text-decoration-none color-3">Water lily lake Acryilic</a>
                                    </div>
                                    <div class="col-4 d-flex align-items-center justify-content-end">
                                        <p class="my-0 color-3">$10,00</p>
                                    </div>
                                </div>
                            </label>
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
                                <input type="text" name="coupon_code" class="form-control rounded-0 shadow-none" placeholder="Coupon Code" />
                                <button class="btn rounded-0 sign-in-button" type="button">Apply Coupon</button>

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
                                    <p class="my-0 subtotal-amount">$11,600</p>
                                </div>
                                <div class="d-flex discounted justify-content-between mb25">
                                    <p class="my-0 discounted-title">Discounted</p>
                                    <p class="my-0 discounted-amount">$11,600</p>
                                </div>
                                <div class="d-flex shipping justify-content-between mb25">
                                    <p class="my-0 shipping-title">Shipping to <span class="shipping-location">Dhaka</span></p>
                                    <p class="my-0 shipping-amount">$20</p>
                                </div>
                                <hr class="mb25" />
                                <div class="d-flex shipping justify-content-between mb25">
                                    <p class="my-0 shipping-title">Total</p>
                                    <p class="my-0 shipping-amount d-flex align-items-center justify-content-end">
                                        $
                                        <input class="bg-transparent px-0 border-0 text-end form-control rounded-0 shadow-none w-50" id="total" type="number" name="total" min="1" value="11620" readonly />
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

    <!-- price calculation -->
    <script>
        window.onload = () => document.querySelectorAll(".input-x").forEach((input) => input.addEventListener("change", calculatePrize));

        function calculatePrize() {
            let sum = 0;
            document.querySelectorAll(".input-x").forEach((input) => (sum += input.checked ? Number.parseFloat(input.getAttribute("data-price")) : 0));
            document.getElementById("total").value = sum;
        }
    </script>
    <!-- price calculation -->
@endpush
