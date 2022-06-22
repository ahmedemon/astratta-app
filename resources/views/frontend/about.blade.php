@extends('layouts.frontend.app', ['pageTitle' => $pageTitle])
@section('content')
    <div class="container-fluid px-0 bg-white product-view-page-container">
        <!-- breadcumb -->
        <div class="container-fluid about-breadcumb px-0">
            <div class="breadcrumb d-flex justify-content-center align-items-center">
                <div class="about-quote">
                    <p class="my-0">“Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut viverra nulla dolor senectus molestie. Consequat praesent nibh convallis viverra ut aenean dolor.”</p>
                    <div class="d-flex align-items-center justify-content-end quoted-by">
                        <img class="h-100" src="{{ asset('frontend/images/line.png') }}" alt="" />
                        <h1 class="my-0">Selim Fresko</h1>
                    </div>
                </div>
            </div>
        </div>
        <!-- breadcumb -->

        <!-- section 1 -->
        <div class="container about-section1">
            <div class="row justify-content-between">
                <div class="col-md-5 px-lg-0 px-xl-0 px-xxl-0">
                    <p class="title my-0">SELIM FRESKO</p>
                    <h1>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</h1>
                    <p class="my-0 details">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vitae odio sit nibh tempor tortor, phasellus penatibus in. Tortor et, rhoncus ipsum vel id venenatis. At in fermentum enim, congue nunc sed lectus odio diam. Neque etiam aenean et duis nunc. Fames aliquam tincidunt habitant egestas et. Aenean auctor rhoncus sollicitudin tellus odio dolor ultrices. Maecenas viverra
                        <br /><br />
                        Nisl, nunc quis aliquet elementum volutpat lorem. Orci sed mauris consequat enim viverra. Quis eros nibh adipiscing massa. Suspendisse est massa purus, <br /><br />
                        nulla scelerisque diam id netus magna lorem. Ut sit rhoncus nunc cursus auctor. Quam vitae scelerisque eget vel. In aliquet lacus sed ut dictum auctor tempor. In in mollis augue erat dui tristique tristique volutpat.
                    </p>
                    <div class="social-links">
                        <a href="" class=""><i class="fab fa-facebook-f"></i></a>
                        <a href="" class=""><i class="fab fa-instagram"></i></a>
                        <a href="" class=""><i class="fab fa-twitter"></i></a>
                    </div>
                </div>
                <div class="col-md-6 px-lg-0 px-xl-0 px-xxl-0">
                    <img class="w-100" src="{{ asset('frontend/images/bg/about1.png') }}" alt="" />
                </div>
            </div>
        </div>
        <div class="container about-section2">
            <div class="row justify-content-between">
                <div class="col-md-6 px-lg-0 px-xl-0 px-xxl-0">
                    <img class="w-100" src="{{ asset('frontend/images/bg/about2.png') }}" alt="" />
                </div>
                <div class="col-md-5 px-lg-0 px-xl-0 px-xxl-0">
                    <p class="title my-0">Selim Fresko</p>
                    <h1>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</h1>
                    <p class="my-0 details">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vitae odio sit nibh tempor tortor, phasellus penatibus in. Tortor et, rhoncus ipsum vel id venenatis. At in fermentum enim, congue nunc sed lectus odio diam. Neque etiam aenean et duis nunc. Fames aliquam tincidunt habitant egestas et. Aenean auctor rhoncus sollicitudin tellus odio dolor ultrices. Maecenas viverra
                        <br /><br />
                        Nisl, nunc quis aliquet elementum volutpat lorem. nibh adipiscing massa. Suspendisse est purus, <br /><br />
                        nulla scelerisque diam id netus magna lorem. Ut sit rhoncus nunc cursus auctor. Quam vitae scelerisque eget vel. In aliquet lacus sed ut dictum auctor tempor. In in mollis augue erat dui tristique tristique volutpat.
                    </p>
                    <div class="social-links">
                        <a href="" class=""><i class="fab fa-facebook-f"></i></a>
                        <a href="" class=""><i class="fab fa-instagram"></i></a>
                        <a href="" class=""><i class="fab fa-twitter"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <!-- section 1 -->

        <!-- meet our top artist -->
        @include('frontend.top-artist')
        <!-- meet our top artist -->
    </div>
@endsection
