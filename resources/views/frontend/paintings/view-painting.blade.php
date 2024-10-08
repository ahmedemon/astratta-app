@extends('layouts.frontend.app', ['pageTitle' => $pageTitle])
@section('content')
    <style>
        .ratio {
            background-color: #00000047 !important;
        }
    </style>
    <div class="container-fluid px-0 bg-white product-view-page-container">
        <!-- product grettings -->
        <div class="container product-section1">
            <div class="content px-2 px-lg-0 px-xl-0 px-xxl-0">
                <div class="row align-items-center justify-content-lg-between justify-content-center hero-section">
                    <div class="product-details px-0 mb-3 mb-lg-0 col-md-12 col-lg-6 col-xl-6 col-xxl-6 col-12">
                        <div class="d-flex align-items-center title">
                            <p class="my-0">{{ $painting->category->name ?? 'Not declared!' }}</p>
                            <img class="h-100" src="{{ asset('frontend/images/line1.png') }}" alt="" />
                        </div>
                        <h1>{{ $painting->product_name }}</h1>
                        <h2>${{ str_replace('.00', '', $painting->product_price) }}</h2>
                        <div class="d-flex justify-content-lg-start justify-content-xl-start justify-content-xxl-start justify-content-between">
                            @if (Auth::guard('seller')->check() ? Auth::guard('seller')->user()->id == $painting->seller_id : '')
                                <a href="{{ route('seller.product.edit', $painting->id) }}" class="btn rounded-0 border-0 buy-now-button">Edit</a>
                            @else
                                @if ($painting->is_purchased == 1 && Auth::guard('web')->check() ? $painting->order->user_id == Auth::user()->id : '')
                                    <a href="{{ route('my-account.index') }}" class="btn rounded-0 border-0 buy-now-button">Track</a>
                                @else
                                    @if ($painting->is_purchased == 1)
                                    @else
                                        <a href="{{ route('checkout.buy.now', $painting->id) }}" class="btn rounded-0 border-0 buy-now-button">Buy Now</a>
                                        <a href="{{ route('my-cart.add-to-cart', $painting->id) }}" class="btn rounded-0 border-0 add-to-cart-button">Add to Cart</a>
                                    @endif
                                @endif
                            @endif
                        </div>
                    </div>
                    <div class="px-0 art col-md-12 col-lg-6 col-xl-6 col-xxl-6 col-12">
                        <div class="d-flex justify-content-lg-end justify-content-xl-end justify-content-xxl-end justify-content-center">
                            <img id="main-image" class="" src="{{ asset($painting->main_image ? 'storage/products/' . $painting->main_image : 'frontend/images/art/art2.png') }}" alt="" />
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid product-section2 bg-light px-0">
            <div class="container photos-section">
                <div class="row">
                    <div class="col-md-4 px-lg-0 px-xl-0 px-xxl-0">
                        <h1 class="my-0">Photos</h1>
                    </div>
                    <div class="col-md-8 px-lg-0 px-xl-0 px-xxl-0 d-flex justify-content-lg-end justify-content-xl-end justify-content-xxl-end justify-content-between">
                        @foreach ($painting->productImages as $key => $image)
                            <a class="thumbnails {{ $key == 0 ? 'text-left' : '' }} {{ $key == 1 ? 'text-center' : '' }} {{ $key == 2 ? 'text-end' : '' }}" href="{{ asset($image->image ? 'storage/products/' . $image->image : 'frontend/images/art/art2.png') }}" data-toggle="lightbox" data-gallery="example-gallery">
                                <img src="{{ asset($image->image ? 'storage/products/' . $image->image : 'frontend/images/art/art2.png') }}" alt="" />
                                {{-- <img onclick="change_image(this)" src="{{ asset($image->image ? 'storage/products/' . $image->image : 'frontend/images/art/art2.png') }}" alt="" /> --}}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="container details-section">
                <div class="row">
                    <div class="col-md-4 px-lg-0 px-xl-0 px-xxl-0">
                        <h1 class="my-0">Details</h1>
                    </div>
                    <div class="col-md-8 px-lg-0 px-xl-0 px-xxl-0">
                        <div class="row">
                            <div class="col-md-6">
                                <ol>
                                    <li>{{ $painting->details_1 }}</li>
                                </ol>
                            </div>
                            <div class="col-md-6">
                                <ol>
                                    <li>{{ $painting->details_2 }}</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container about-paint-section">
                <div class="row">
                    <div class="col-md-4 px-lg-0 px-xl-0 px-xxl-0">
                        <h1 class="my-0">About this Paint</h1>
                    </div>
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-12 px-lg-2 px-xl-2 px-xxl-2">
                                <p class="my-0">{{ $painting->about_this_paint }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container about-section">
                <div class="row">
                    <div class="col-md-12 bg-white">
                        <div class="row">
                            <div class="col-md-12 headings d-flex justify-content-lg-start align-items-lg-center">
                                <img class="rounded-circle" src="{{ $painting->seller->image ? asset('storage/seller/' . $painting->seller->image) : asset('frontend/images/artist/artist.png') }}" alt="" />
                                <div class="info">
                                    <h1 class="my-0">{{ $painting->seller->name }}</h1>
                                    <p class="my-0">{{ $painting->seller->designation }}</p>
                                </div>
                            </div>
                            <div class="col-md-12 description">
                                <p class="my-0">{{ $painting->seller->description }}</p>
                                <a href="{{ route('artist.show', $painting->seller_id) }}" class="">Learn More</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid product-section3 bg-white px-0">
            <div class="container section2-container-2 px-lg-0">
                <div class="d-flex justify-content-between align-items-center section-heading">
                    <h1 class="my-0">Related Painting</h1>
                    <img class="h-100" src="{{ asset('frontend/images/line1.png') }}" alt="" />
                </div>
                <div class="row best-selling-container justify-content-lg-between justify-content-md-between justify-content-center w-100">
                    @foreach ($relatedProducts as $product)
                        <div class="col-lg-6 col-xl-4 col-md-6 col-6 painting">
                            <a href="{{ route('painting.show', $product->id) }}">
                                <img class="p-3" src="{{ asset('storage/products/' . $product->main_image) }}" alt="" />
                                <h3>{{ $product->product_name }}</h3>
                                <p class="my-0">${{ str_replace('.00', '', $product->product_price) }}</p>
                                <div class="d-flex align-items-center justify-content-lg-start justify-content-between buy-now">
                                    <a href="javascript:void();" class=""><small class="my-0">Buy Now</small></a>
                                    <div class="d-flex align-items-center">
                                        <svg width="33" height="8" viewBox="0 0 33 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M32.3536 4.35355C32.5488 4.15829 32.5488 3.84171 32.3536 3.64644L29.1716 0.464464C28.9763 0.269201 28.6597 0.269201 28.4645 0.464464C28.2692 0.659726 28.2692 0.976308 28.4645 1.17157L31.2929 4L28.4645 6.82842C28.2692 7.02369 28.2692 7.34027 28.4645 7.53553C28.6597 7.73079 28.9763 7.73079 29.1716 7.53553L32.3536 4.35355ZM4.37114e-08 4.5L32 4.5L32 3.5L-4.37114e-08 3.5L4.37114e-08 4.5Z" fill="black" />
                                        </svg>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <!-- product grettings -->
    </div>
@endsection


@push('js')
    <script src="https://cdn.jsdelivr.net/npm/bs5-lightbox@1.8.0/dist/index.bundle.min.js"></script>
    <script>
        const options = {
            keyboard: true,
            size: 'fullscreen'
        };
        document.querySelectorAll('.my-lightbox-toggle').forEach((el) => el.addEventListener('click', (e) => {
            e.preventDefault();
            const lightbox = new Lightbox(el, options);
            lightbox.show();
        }));

        // function change_image(image) {
        //     var container = document.getElementById("main-image");

        //     container.src = image.src;
        // }
        // document.addEventListener("DOMContentLoaded", function(event) {});
    </script>
@endpush
