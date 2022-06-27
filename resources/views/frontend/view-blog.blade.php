@extends('layouts.frontend.app', ['pageTitle' => $pageTitle])
@section('content')
    <div class="container-fluid px-0 bg-white product-view-page-container">
        <!-- blog heading -->
        <style>
            .blog-heading {
                background-image: url("{{ asset('frontend/images/art/blog-bg.png') }}");
                background-repeat: no-repeat;
                background-size: 100% 100%;
                position: relative;
            }

            .blog-heading-background {
                height: 100%;
                width: 100%;
                position: absolute;
                background: #380f28b3;
                backdrop-filter: blur(70px);
            }

            .heading-content-box {
                z-index: 999 !important;
                position: relative;
                color: white;
                width: 945px;
            }
        </style>
        <div class="blog-heading">
            <div class="blog-heading-background"></div>
            <div class="container px-lg-0 px-xl-0 px-xxl-0 heading-content-box pt96">
                <p class="my-0 mb30-important"><a href="/" class="text-decoration-none">Home</a> / <a href="{{ route('blogs') }}" class="text-decoration-none">Blog</a>/ <a href="{{ route('blog', $blog->id) }}" class="text-decoration-none">{{ $blog->title }}</a></p>
                <h2 class="my-0 mb25-important">{{ $blog->title }}</h2>
                <a href="javascript:void();" class="btn category-btn btn-sm">{{ $blog->category }}</a>
            </div>
        </div>
        <!-- blog heading -->
        <div class="container blog-details">
            <div class="container px-0 details-content-box">
                <img src="{{ asset('frontend/images/art/blog.png') }}" alt="" />
                <h3 class="mb-0">{{ $blog->title }}</h3>
                <p class="mb-0 pb96">
                    {{ $blog->description }}
                </p>
            </div>
        </div>

        <!-- related blog -->
        <div class="view-blog">
            @include('frontend.related-blog')
        </div>
        <!-- related blog -->

        <!-- blog details -->
        <div class="container-fluid px-0"></div>
        <!-- blog details -->
    </div>
@endsection
