<nav class="navbar navbar-expand-lg bg-white sticky-top shadow">
    <div class="container px-lg-0 align-items-center">
        <ul class="navbar-nav me-auto mb-lg-0 d-lg-none">
            <li class="nav-item">
                <a class="nav-link" href="">
                    <img width="100px" src="{{ asset('frontend/images/logo.png') }}" alt="" />
                </a>
            </li>
        </ul>
        <div class="nav-left d-lg-block d-none">
            <a class="nav-links text-decoration-none" href="{{ route('painting.index') }}">Paintings</a>
            <a class="nav-links text-decoration-none" href="{{ route('artist.index') }}">Artists</a>
        </div>
        <div class="nav-right d-lg-none d-lg-block ms-0 mx-auto">
            <a href="javascript:void();" class="">
                <img src="{{ asset('frontend/svg/phone.svg') }}" alt="" />
            </a>
            <a href="{{ route('my-cart.index') }}" class="">
                <img src="{{ asset('frontend/svg/cart.svg') }}" alt="" />
            </a>
            <a href="{{ Auth::guard('seller')->user() ? route('seller.dashboard.index') : (Auth::user() ? route('my-account.index') : route('login')) }}" class="">
                <img src="{{ asset('frontend/svg/profile.svg') }}" alt="" />
            </a>
        </div>
        <button class="navbar-toggler btn sign-in-button px-2 rounded-0 border border-dark" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-sliders-h"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav m-auto mb-lg-0 d-none d-lg-block">
                <li class="nav-item">
                    <a class="nav-link" href="/">
                        <img width="170px" src="{{ asset('frontend/images/logo.png') }}" alt="" />
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav m-auto mt-3 d-block d-lg-none">
                <li class="nav-item">
                    <a class="btn btn-sm sign-in-button rounded-0 nav-menu w-100 text-start text-decoration-none" href="{{ route('painting.index') }}">Paintings</a>
                </li>
                <li class="nav-item">
                    <a class="btn btn-sm sign-in-button rounded-0 nav-menu w-100 text-start text-decoration-none" href="{{ route('artist.index') }}">Artists</a>
                </li>
            </ul>
            <div class="nav-right d-none d-lg-block">
                <div class="d-flex">
                    <a href="javascript:void();" class="">
                        <img src="{{ asset('frontend/svg/phone.svg') }}" alt="" />
                    </a>
                    <a href="{{ route('my-cart.index') }}" class="">
                        <img src="{{ asset('frontend/svg/cart.svg') }}" alt="" />
                    </a>
                    <a href="{{ Auth::guard('seller')->user() ? route('seller.dashboard.index') : (Auth::user() ? route('my-account.index') : route('login')) }}" class="">
                        <img src="{{ asset('frontend/svg/profile.svg') }}" alt="" />
                    </a>
                </div>
            </div>
        </div>
    </div>
</nav>
