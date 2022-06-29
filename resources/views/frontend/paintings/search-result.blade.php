@extends('layouts.frontend.app', ['pageTitle' => $pageTitle])
@section('content')
    <div class="container-fluid px-0 bg-white product-view-page-container">
        <!-- breadcrumb -->
        <div class="search-breadcrumb container-fluid px-0">
            <div class="container px-0">
                <div class="breadcrumb-background d-flex justify-content-center align-items-center">
                    <div>
                        <h1>{{ $pageTitle }}</h1>
                        <form action="{{ route('painting.search') }}" method="POST" class="d-flex justify-content-center">
                            @csrf
                            @method('GET')
                            <div class="input-group">
                                <input type="text" name="search_key" class="form-control shadow-none border border-right-0" placeholder="Search Here..." value="{{ $key }}" autocomplete="search_key" />
                                <button class="btn border-0" type="submit">
                                    <img src="{{ asset('frontend/images/search-icon.png') }}" alt="" />
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- breadcrumb -->

        <!-- shorting start -->
        <div class="container px-lg-0">
            <div class="row shorting-section justify-content-between">
                <div class="col-lg-8">
                    <div class="d-flex justify-content-lg-start justify-content-xl-startjustify-content-lg-start justify-content-xxl-startjustify-content-lg-start justify-content-center">
                        <a href="javascript:void();" class="btn border border-dark">1K - 5K</a>
                        <a href="javascript:void();" class="btn border border-dark">10K - 50K</a>
                        <a href="javascript:void();" class="btn border border-dark">100K - 200K</a>
                        <a href="javascript:void();" class="btn border border-dark">500K - 1M</a>
                    </div>
                </div>

                <div class="col-lg-4 d-flex justify-content-lg-end justify-content-xl-end justify-content-xxl-end justify-content-center">
                    <div class="dropdown">
                        <button class="btn border border-dark" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">Sort...<i class="fas fa-chevron-down"></i></button>
                        <ul class="dropdown-menu py-0 border-0" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item border border-dark mt-1" href="javascript:void();">Default</a></li>
                            <li><a class="dropdown-item border border-dark mt-1" href="javascript:void();">Newest First</a></li>
                            <li><a class="dropdown-item border border-dark mt-1" href="javascript:void();">Oldest First</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- shorting end -->

        <!-- paintings section -->
        <div class="container section2-container-2 px-lg-0">
            <div class="row best-selling-container justify-content-lg-between justify-content-md-between justify-content-center w-100">
                @foreach ($paintings as $painting)
                    @php
                        $image = $painting->productImages->first();
                    @endphp
                    <div class="col-lg-6 col-xl-4 col-md-6 col-6 painting">
                        <a href="{{ route('painting.show', $painting->id) }}">
                            <img class="p-3" src="{{ asset('storage/products/' . $image->image) }}" alt="" />
                            <h3>{{ $painting->product_name }}</h3>
                            <p class="my-0">{{ str_replace('.00', '', $painting->product_price) }}</p>
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
        <!-- paintings section -->
    </div>
@endsection
