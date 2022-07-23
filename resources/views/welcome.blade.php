@extends('layouts.frontend.app', ['pageTitle' => $pageTitle])
@section('content')
    <div class="container-fluid px-0 bg-white product-view-page-container">
        <!-- section 1 start -->
        <div class="section1">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 px-lg-0">
                        <div class="section1-content d-flex align-items-center">
                            <div>
                                <h1 class="headings1">Lorem ipsum dolor sit, adipiscing elit. Odio vitae vitae magnis.</h1>
                                <div class="d-inline-flex align-items-center">
                                    <a href="{{ Auth::guard('seller')->check() ? route('seller.dashboard.index') : route('seller.join-us') }}" class="start-selling-link">Start selling your paintings</a>
                                    <p class="my-0 text-white">Paintings</p>
                                </div>
                                <br />
                                <div class="total-artist d-inline-flex align-items-center">
                                    <div class="d-inline-flex">
                                        <img src="{{ asset('frontend/images/artist/1.png') }}" alt="" />
                                        <img src="{{ asset('frontend/images/artist/2.png') }}" alt="" />
                                        <img src="{{ asset('frontend/images/artist/3.png') }}" alt="" />
                                        <img src="{{ asset('frontend/images/artist/4.png') }}" alt="" />
                                    </div>
                                    <small>Over 200+ Artists<br />in astratta</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 px-lg-0 d-md-block d-lg-block d-xl-block d-xxl-block d-none">
                        <div class="art-demo-container d-flex justify-content-lg-end justify-content-center">
                            <img src="{{ asset('frontend/images/art/hero.png') }}" alt="" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- section 1 end -->

        <!-- section 2 start -->
        <div class="section2">
            <div class="container section2-container-1 px-0">
                <div class="row justify-content-lg-between justify-content-center justify-content-md-between justify-content-xl-between justify-content-xxl-between mx-auto">
                    <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4 col-sm-4 col-xs-4 col-4">
                        <img src="{{ asset('frontend/images/art/demo1.png') }}" alt="" />
                    </div>
                    <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4 col-sm-4 col-xs-4 col-4">
                        <img src="{{ asset('frontend/images/art/demo2.png') }}" alt="" />
                    </div>
                    <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4 col-sm-4 col-xs-4 col-4">
                        <img src="{{ asset('frontend/images/art/demo3.png') }}" alt="" />
                    </div>
                </div>
            </div>
            <div class="container section2-container-2 px-lg-0">
                <div class="d-flex justify-content-between align-items-center section-heading">
                    <h2>Best Selling</h2>
                    <img class="h-100" src="{{ asset('frontend/images/line1.png') }}" alt="" />
                </div>
                <div class="row best-selling-container justify-content-lg-between justify-content-md-between justify-content-center w-100">
                    @if ($best_sellings->count() == 0)
                        <h4 class="text-center mt-5">No paint uploaded yet!!</h4>
                    @else
                        @foreach ($best_sellings as $best)
                            <div class="col-lg-6 col-xl-4 col-md-6 col-6 painting">
                                <a href="{{ route('painting.show', $best->id) }}">
                                    <img class="p-3" src="{{ asset('storage/products/' . $best->main_image) }}" alt="" />
                                    <h3 class="my-0">Lorem Ipsum is simply dummy text of the printing and</h3>
                                    <p class="my-0">$5000</p>
                                    <div class="d-flex align-items-center justify-content-lg-start justify-content-between buy-now">
                                        <a href="{{ route('checkout.buy.now', $best->id) }}" class=""><small class="my-0">Buy Now</small></a>
                                        <div class="d-flex align-items-center">
                                            <svg width="33" height="8" viewBox="0 0 33 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M32.3536 4.35355C32.5488 4.15829 32.5488 3.84171 32.3536 3.64644L29.1716 0.464464C28.9763 0.269201 28.6597 0.269201 28.4645 0.464464C28.2692 0.659726 28.2692 0.976308 28.4645 1.17157L31.2929 4L28.4645 6.82842C28.2692 7.02369 28.2692 7.34027 28.4645 7.53553C28.6597 7.73079 28.9763 7.73079 29.1716 7.53553L32.3536 4.35355ZM4.37114e-08 4.5L32 4.5L32 3.5L-4.37114e-08 3.5L4.37114e-08 4.5Z" fill="black" />
                                            </svg>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>

            <!-- meet our top artist -->
            @include('frontend.top-artist')
            <!-- meet our top artist -->

            <div class="row container mx-auto px-lg-0">
                <div class="container cta-section bg-white d-flex align-items-center px-lg-0">
                    <div class="row">
                        <div class="col-md-12 px-lg-0">
                            <h1>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</h1>
                            <div class="d-inline-flex align-items-center">
                                <a href="{{ Auth::guard('seller')->check() ? route('seller.dashboard.index') : route('seller.join-us') }}" class="start-selling-link">Start selling your paintings</a>
                                <p class="my-0 text-dark">Paintings</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- blog site -->
            @include('frontend.featured-blog')
            <!-- blog site -->
        </div>

        <!-- section 2 end -->
    </div>
@endsection
