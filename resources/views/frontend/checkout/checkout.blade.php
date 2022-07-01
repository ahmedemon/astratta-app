@extends('layouts.frontend.app', ['pageTitle' => $pageTitle])
@section('content')
    <div class="container-fluid px-0 bg-white checkout-page" id="custom-breadcrumb">
        <!-- breadcrumb start -->
        <div class="breadcrumb">
            <div class="container d-flex align-items-center px-0">
                <div class="bct">
                    <h1 class="my-0">Checkout</h1>
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

        <form action="{{ route('checkout.place.order') }}" method="POST">
            @csrf
            <div class="billing-details bg-light">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-8 bg-white billing-cart">
                            <h3 class="my-0 mb35">Billing Detials</h3>
                            <div class="row justify-content-between">
                                <div class="col-md-6 mb30">
                                    <div class="inputGroup">
                                        <label for="first_name">First Name</label>
                                        <input id="first_name" name="first_name" value="{{ strtok(Auth::user()->name ?? '', ' ') }}" type="text" class="form-control border-0 border-bottom border-secondary rounded-0 shadow-none px-0 pb-1 pt-0" placeholder="John Doe" />
                                        @error('first_name')
                                            <span class="invalid-feedback" role="alert">
                                                <small>{{ $message }}</small>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 mb30">
                                    <div class="inputGroup">
                                        <label for="last_name">Last Name</label>
                                        <input id="last_name" name="last_name" value="{{ basename(str_replace(' ', '/', Auth::user()->name ?? '')) }}" type="text" class="form-control border-0 border-bottom border-secondary rounded-0 shadow-none px-0 pb-1 pt-0" placeholder="John Doe" />
                                        @error('last_name')
                                            <span class="invalid-feedback" role="alert">
                                                <small>{{ $message }}</small>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 mb30">
                                    <div class="inputGroup">
                                        <label for="phone">Phone</label>
                                        <input id="phone" name="phone" value="{{ Auth::user()->phone ?? '' }}" type="tel" class="form-control border-0 border-bottom border-secondary rounded-0 shadow-none px-0 pb-1 pt-0" placeholder="John Doe" />
                                        @error('phone')
                                            <span class="invalid-feedback" role="alert">
                                                <small>{{ $message }}</small>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 mb30">
                                    <div class="inputGroup">
                                        <label for="email">Email</label>
                                        <input id="email" name="email" value="{{ Auth::user()->email ?? '' }}" type="email" class="form-control border-0 border-bottom border-secondary rounded-0 shadow-none px-0 pb-1 pt-0" placeholder="John Doe" />
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <small>{{ $message }}</small>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12 mb30">
                                    <div class="inputGroup">
                                        <label for="country">Country</label>
                                        <input id="country" name="country" value="{{ Auth::user()->billing->country ?? '' }}" type="text" class="form-control border-0 border-bottom border-secondary rounded-0 shadow-none px-0 pb-1 pt-0" placeholder="John Doe" />
                                        @error('country')
                                            <span class="invalid-feedback" role="alert">
                                                <small>{{ $message }}</small>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12 mb30">
                                    <div class="inputGroup">
                                        <label for="state">State</label>
                                        <input id="state" name="state" value="{{ Auth::user()->billing->state ?? '' }}" type="text" class="form-control border-0 border-bottom border-secondary rounded-0 shadow-none px-0 pb-1 pt-0" placeholder="John Doe" />
                                        @error('state')
                                            <span class="invalid-feedback" role="alert">
                                                <small>{{ $message }}</small>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12 mb30">
                                    <div class="inputGroup">
                                        <label for="town_city">Town / City</label>
                                        <input id="town_city" name="town_city" value="{{ Auth::user()->billing->town_city ?? '' }}" type="text" class="form-control border-0 border-bottom border-secondary rounded-0 shadow-none px-0 pb-1 pt-0" placeholder="John Doe" />
                                        @error('town_city')
                                            <span class="invalid-feedback" role="alert">
                                                <small>{{ $message }}</small>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12 mb30">
                                    <div class="inputGroup">
                                        <label for="street">Street Address</label>
                                        <input id="street" name="street" value="{{ Auth::user()->billing->street ?? '' }}" type="text" class="form-control border-0 border-bottom border-secondary rounded-0 shadow-none px-0 pb-1 pt-0" placeholder="John Doe" />
                                        @error('street')
                                            <span class="invalid-feedback" role="alert">
                                                <small>{{ $message }}</small>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="inputGroup">
                                        <label for="post_or_zip">Postcode / ZIP (Optional)</label>
                                        <input id="post_or_zip" name="post_or_zip" value="{{ Auth::user()->billing->post_or_zip ?? '' }}" type="text" class="form-control border-0 border-bottom border-secondary rounded-0 shadow-none px-0 pb-1 pt-0" placeholder="John Doe" />
                                        @error('post_or_zip')
                                            <span class="invalid-feedback" role="alert">
                                                <small>{{ $message }}</small>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- product list -->
            <div class="cart-product-list bg-light">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-8 bg-white cart">
                            <div class="row cart-heading">
                                <div class="col-6">
                                    <p class="my-0">Your Order</p>
                                </div>
                                <div class="col-6 text-end">
                                    <p class="my-0">Price</p>
                                </div>
                            </div>
                            <input type="hidden" name="coupon_code" value="{{ Crypt::encrypt($coupon_code) }}">
                            <input type="hidden" name="total_cost" value="{{ Crypt::encrypt($total_cost) }}">
                            @foreach ($items as $key => $item)
                                <input type="hidden" name="items[{{ $key }}][product_id]" value="{{ $item['product_id'] }}">
                                <input type="hidden" name="items[{{ $key }}][cart_item_id]" value="{{ $item['cart_item_id'] }}">
                                <div class="row cart-body">
                                    <div class="col-8 d-flex align-items-center">
                                        <i class="lni lni-close"></i>
                                        <img class="product-image" src="{{ asset('storage/products/' . config('image.product')->image) }}" alt="" />
                                        <a class="text-decoration-none">La Réunion Acryilic</a>
                                    </div>
                                    <div class="col-4 d-flex align-items-center justify-content-end">
                                        <p class="my-0">$400</p>
                                    </div>
                                </div>
                            @endforeach
                            <div class="checkout-total bg-white">
                                <hr class="mb10" style="opacity: 1 !important" />
                                <div class="d-flex discounted justify-content-between mb10">
                                    <p class="my-0 discounted-title">Discounted</p>
                                    <p class="my-0 discounted-amount">$11,600</p>
                                </div>
                                <div class="d-flex shipping justify-content-between mb10">
                                    <p class="my-0 shipping-title">Shipping to Dhaka</p>
                                    <p class="my-0 shipping-amount">$20</p>
                                </div>
                                <div class="d-flex shipping justify-content-between">
                                    <p class="my-0 total-title">Total</p>
                                    <p class="my-0 total-amount d-flex align-items-center justify-content-end">{{ '$' . $total_cost }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- product list -->

            <!-- cart total -->
            <div class="cart-payment bg-light">
                <div class="container px-lg-0 px-xl-0 px-xxl-0">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="cart-payment-body bg-white">
                                <div class="row payment-heading">
                                    <div class="col-6">
                                        <p class="my-0">Pay</p>
                                    </div>
                                    <div class="col-6 text-end">
                                        <p class="my-0">$11,620</p>
                                    </div>
                                </div>
                                <div class="payment-body">
                                    <p class="my-0 payment-notice mb30">
                                        Your personal data will be used to process your order, support your <br />
                                        experience throughout this website, and for other purposes described in our privacy policy.
                                    </p>

                                    <div class="method mb40">
                                        <a href="javascript::void();" class="d-flex justify-content-start align-items-center btn rounded-0 border-0 shadow-none w-100 bg-light payment-button mb30" type="button" data-bs-toggle="collapse" data-bs-target="#checkPaymentcollaspe" aria-expanded="false" aria-controls="checkPaymentcollaspe">Check Payment</a>
                                        <div class="collapse collapse-vertical mb30" id="checkPaymentcollaspe">
                                            <div class="card card-body" style="width: 300px">This is some placeholder content for a horizontal collapse. It's hidden by default and shown when triggered.</div>
                                        </div>
                                        <a href="javascript::void();" class="d-flex justify-content-start align-items-center btn rounded-0 border-0 shadow-none w-100 bg-light payment-button mb30" type="button" data-bs-toggle="collapse" data-bs-target="#cardPaymentcollaspe" aria-expanded="false" aria-controls="cardPaymentcollaspe">Card Payment</a>
                                        <div class="collapse collapse-vertical mb30" id="cardPaymentcollaspe">
                                            <div class="card card-body" style="width: 300px">This is some placeholder content for a horizontal collapse. It's hidden by default and shown when triggered.</div>
                                        </div>
                                        <a href="javascript::void();" class="d-flex justify-content-start align-items-center btn rounded-0 border-0 shadow-none w-100 bg-light payment-button mb30" type="button" data-bs-toggle="collapse" data-bs-target="#paypalPaymentcollaspe" aria-expanded="false" aria-controls="paypalPaymentcollaspe">Paypal</a>
                                        <div class="collapse collapse-vertical mb30" id="paypalPaymentcollaspe">
                                            <div class="card card-body" style="width: 300px">This is some placeholder content for a horizontal collapse. It's hidden by default and shown when triggered.</div>
                                        </div>
                                    </div>
                                    <button type="submit" class="d-flex align-items-center justify-content-center w-100 btn rounded-0 border-0 sign-up-button checkout-button">Proceed</button>
                                </div>
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
        $(function() {
            $("input:radio").click(function(e) {
                e.stopPropagation();
                $("li").removeClass("active");
                $(this).parent().parent().addClass("active");
            });
            $("a").click(function(e) {
                $(this).children().trigger("click");
            });
        });
    </script>
@endpush
