<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ 'Astratta - ' . $pageTitle ?? '' }}</title>
    <!-- cdn links -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet" />
    <!-- cdn links -->

    <!-- local link -->
    <link rel="stylesheet" href="{{ asset('vendor/css/custom.css') }}" />
    <link rel="stylesheet" href="{{ asset('vendor/css/media-query.css') }}" />
    <link rel="stylesheet" href="{{ asset('vendor/css/owl.carousel.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('vendor/css/owl.theme.default.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('vendor/css/profile-cropper.css') }}" />

    <link rel="stylesheet" href="{{ asset('vendor/css/layout/header.css') }}" />
    <link rel="stylesheet" href="{{ asset('vendor/css/layout/side-nav.css') }}" />
    <link rel="stylesheet" href="{{ asset('vendor/css/layout/footer.css') }}" />

    <link rel="stylesheet" href="{{ asset('vendor/css/vendor/breadcrumb.css') }}" />
    <link rel="stylesheet" href="{{ asset('vendor/css/vendor/custom-buttons.css') }}" />
    <link rel="stylesheet" href="{{ asset('vendor/css/vendor/preset.css') }}" />
    <link rel="stylesheet" href="{{ asset('vendor/css/vendor/chart.css') }}" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css" />
    <link rel="stylesheet" href="{{ asset('vendor/css/select2.min.css') }}" />
    <!-- local link -->
</head>

<body>
    <!-- navbar start -->
    @include('sweetalert::alert')
    @include('layouts.frontend.header')
    <!-- navbar end -->
    <!-- breadcrumb start -->
    <div class="breadcrumb">
        <div class="container d-flex align-items-center px-lg-0 px-xl-0 px-xxl-0">
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
    @yield('content')
    <!-- footer start -->
    @include('layouts.frontend.footer')
    <!-- footer end -->
</body>

</html>

<!-- cdn scripts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

{{-- <script src="{{ asset('vendor/js/owl.carousel.min.js') }}"></script> --}}
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js"></script>

{{-- select2 & images loader --}}
@if (Request::is('seller/products/*'))
    <script src="{{ asset('vendor/js/select2.min.js') }}"></script>
    {{-- <script src="{{ asset('vendor/js/jquery.imagesloader-1.0.1.js') }}"></script> --}}
@endif
{{-- select2 & images loader --}}

{{-- profile cropper --}}
@if (Request::is('seller/profile'))
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>
@endif
{{-- profile cropper --}}

{{-- datatables --}}
@if (Request::is('seller/products'))
    <script src="{{ asset('vendor/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/js/dataTables.bootstrap5.min.js') }}"></script>
@endif
{{-- datatables --}}

{{-- chart --}}
@if (Request::is('seller/dashboard'))
    <script src="{{ asset('vendor/js/Chart.min.js') }}"></script>
    <script src="{{ asset('vendor/js/chart-area.js') }}"></script>
@endif
{{-- chart --}}

<!-- cdn scripts -->
<script>
    function sideBarToggle() {
        var element = document.getElementById("sideMenuBar");
        element.classList.toggle("toggle-menubar");
    }
    $(document).ready(function() {
        $("#closeButton").on("click", function() {
            $("#sideMenuBar").toggleClass("toggle-menubar");
            return false;
        });
    });
</script>

@stack('js')
