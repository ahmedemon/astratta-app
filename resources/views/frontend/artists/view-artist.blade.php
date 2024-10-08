@extends('layouts.frontend.app', ['pageTitle' => $pageTitle])
@section('content')
    <style>
        .no-paint {
            font-family: 'Crucial' !important;
            font-style: normal;
            font-weight: 500;
            color: #000000;
        }
    </style>
    <div class="container-fluid px-0 bg-white product-view-page-container">
        <!-- artist details -->
        <div class="container view-artist">
            <div class="row justify-content-md-between justify-content-lg-between justify-content-xl-between justify-content-xxl-between justify-content-center">
                <div class="left-side col-md-5 px-lg-0">
                    <div class="card border-0 bg-transparent">
                        <img class="rounded-circle" src="{{ $artist->image ? asset('storage/seller/' . $artist->image) : asset('vendor/images/artist/avatar.svg') }}" alt="" />
                        <h3 class="my-0">{{ $artist->name ?? $artist->username }}</h3>
                        <p class="my-0">{{ $artist->designation ?? 'Not Set!' }}</p>
                        <hr class="my-0" />
                        <div class="artist-description">
                            <p class="my-0">
                                {{ $artist->description ?? 'Nothing Declared!' }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="right-side col-md-6 section2-container-2">
                    <div class="row justify-content-between">
                        @if ($myProducts->count() == 0)
                            <h3 class="no-paint text-center mt-5">No paint uploaded yet!</h3>
                        @else
                            @foreach ($myProducts as $product)
                                <div class="col-6 px-lg-0 best-selling-container painting">
                                    <a href="{{ route('painting.show', $product->id) }}">
                                        <img class="p-3" src="{{ asset('storage/products/' . $product->main_image) }}" alt="" />
                                        <h3>{{ $product->product_name }}</h3>
                                        <p class="my-0">${{ $product->product_price }}</p>
                                        <div class="d-flex align-items-center justify-content-lg-start justify-content-between buy-now">
                                            @if ($product->is_purchased == 1)
                                                <a href="javascript::void();" class=""><small class="my-0">Sold Out!</small></a>
                                            @else
                                                <a href="{{ route('checkout.buy.now', $product->id) }}" class=""><small class="my-0">Buy Now</small></a>
                                                <div class="d-flex align-items-center">
                                                    <svg width="33" height="8" viewBox="0 0 33 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M32.3536 4.35355C32.5488 4.15829 32.5488 3.84171 32.3536 3.64644L29.1716 0.464464C28.9763 0.269201 28.6597 0.269201 28.4645 0.464464C28.2692 0.659726 28.2692 0.976308 28.4645 1.17157L31.2929 4L28.4645 6.82842C28.2692 7.02369 28.2692 7.34027 28.4645 7.53553C28.6597 7.73079 28.9763 7.73079 29.1716 7.53553L32.3536 4.35355ZM4.37114e-08 4.5L32 4.5L32 3.5L-4.37114e-08 3.5L4.37114e-08 4.5Z" fill="black" />
                                                    </svg>
                                                </div>
                                            @endif
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!-- artist details -->

        <!-- meet our top artist -->
        @include('frontend.top-artist')
        <!-- meet our top artist -->
    </div>
@endsection
