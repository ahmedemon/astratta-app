<nav class="navbar navbar-expand-lg bg-white sticky-top shadow">
    <div class="container px-lg-0 px-xl-0 px-xxl-0 px-5 align-items-center">
        <ul class="navbar-nav me-auto mb-lg-0 d-lg-none">
            <li class="nav-item">
                <a class="nav-link" href="">
                    <img width="100px" src="{{ asset('frontend/images/logo.png') }}" alt="" />
                </a>
            </li>
        </ul>
        <div class="nav-right d-lg-none d-block">
            <a href="{{ route('my-cart.index') }}" class="">
                <img height="30px" src="{{ asset('frontend/svg/cart.svg') }}" alt="" />
            </a>
        </div>
        <div class="nav-left d-lg-block d-none">
            <a class="nav-links text-decoration-none" href="{{ route('painting.index') }}">Paintings</a>
            <a class="nav-links text-decoration-none" href="{{ route('artist.index') }}">Artists</a>
        </div>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav m-auto mb-lg-0 d-none d-lg-block">
                <li class="nav-item">
                    <a class="nav-link" href="/">
                        <img width="170px" src="{{ asset('frontend/images/logo.png') }}" alt="" />
                    </a>
                </li>
            </ul>
            <div class="nav-right d-none d-lg-block">
                <div class="d-flex">
                    <a href="tel:01940546604" class="">
                        <img height="30px" src="{{ asset('frontend/svg/phone.svg') }}" alt="" />
                    </a>
                    <a href="{{ route('my-cart.index') }}" class="">
                        <img height="30px" src="{{ asset('frontend/svg/cart.svg') }}" alt="" />
                    </a>
                    <a href="{{ Auth::guard('seller')->user() ? route('seller.dashboard.index') : (Auth::user() ? route('my-account.index') : route('login')) }}" class="">
                        <img height="30px" src="{{ asset('frontend/svg/profile.svg') }}" alt="" />
                    </a>
                </div>
            </div>
        </div>
    </div>
</nav>

<nav class="navbar navbar-expand-lg bg-white fixed-bottom shadow d-lg-none d-xl-none d-xxl-none d-flex align-items-center" style="height: 65px !important;">
    <div class="container px-lg-0 px-5 justify-content-between">
        <a href="/" class="">
            <img height="30px" src="{{ asset('frontend/svg/home.svg') }}" alt="" />
        </a>
        <a href="{{ route('painting.index') }}" class="">
            <img height="30px" src="{{ asset('frontend/svg/paintings.svg') }}" alt="" />
        </a>
        <a href="tel:01940546604" class="">
            <img height="32px" src="{{ asset('frontend/svg/phone.svg') }}" alt="" />
        </a>
        <a href="{{ Auth::guard('seller')->user() ? route('seller.dashboard.index') : (Auth::user() ? route('my-account.index') : route('login')) }}" class="">
            <img height="32px" src="{{ asset('frontend/svg/profile.svg') }}" alt="" />
        </a>
    </div>
</nav>
