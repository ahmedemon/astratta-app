@extends('layouts.frontend.app', ['pageTitle' => $pageTitle])
@section('content')
    <div class="container-fluid px-0 bg-white product-view-page-container">
        <!-- breadcrumb -->
        <div class="search-breadcrumb container-fluid px-0">
            <div class="container px-0">
                <div class="breadcrumb-background d-flex justify-content-center align-items-center">
                    <div>
                        <h1>Search Blogs</h1>
                        <form action="" method="GET" class="d-flex justify-content-center">
                            <div class="input-group">
                                <input type="text" class="form-control shadow-none border border-right-0" placeholder="Search Here..." />
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

        <!-- blogs section -->
        <div class="blogs-page">
            <!-- shorting start -->
            <div class="container px-lg-0">
                <div class="row shorting-section justify-content-between">
                    <div class="col-lg-8">
                        <div class="d-flex justify-content-lg-start justify-content-xl-startjustify-content-lg-start justify-content-xxl-startjustify-content-lg-start justify-content-center">
                            <a href="javascript:void();" class="btn border border-dark">Abstract</a>
                            <a href="javascript:void();" class="btn border border-dark">Normal</a>
                            <a href="javascript:void();" class="btn border border-dark">Filter 3</a>
                            <a href="javascript:void();" class="btn border border-dark">sdf</a>
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
            <div class="container blog-site px-lg-0">
                <div class="row justify-content-between mx-auto">
                    @foreach ($blogs as $blog)
                        <div class="col-lg-4 col-xl-4 col-xxl-4 col-md-4 col-6 item px-lg-0 px-xl-0 px-xxl-0">
                            <a href="{{ route('blog', $blog->id) }}" class="text-decoration-none text-dark">
                                <div class="col-md-12">
                                    <img class="" src="{{ asset('frontend/images/blog-demo.png') }}" alt="" />
                                    <p class="author my-0">{{ $blog->topic }}</p>
                                    <p class="title my-0">{{ $blog->title }}</p>
                                    <p class="description my-0">{{ $blog->description }}</p>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <!-- blogs section -->
    </div>
@endsection
