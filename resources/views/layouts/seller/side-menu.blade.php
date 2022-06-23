<div class="col-md-3 col-lg-3 col-xl-3 col-xxl-3 col-12 side-nav py30 px20 d-lg-block d-xl-block d-xxl-block" id="sideMenuBar">
    <button class="btn btn-outline-danger d-lg-none d-xl-none d-xxl-none" id="closeButton"><i class="fas fa-times"></i></button>
    <div class="vendor-info d-grid justify-content-center align-items-center mb45">
        <img class="vendor-profile-image mx-auto mb20 rounded-circle" src="{{ Auth::guard('seller')->user()->image ? asset('storage/seller/' . Auth::guard('seller')->user()->image) : asset('vendor/images/artist/avatar.svg') }}" alt="" />
        <h1 class="my-0 mb5-i">{{ Auth::guard('seller')->user()->name ?? Auth::guard('seller')->user()->username }}</h1>
        <p class="my-0">
            @if (Auth::guard('seller')->user()->designation)
                {{ Auth::guard('seller')->user()->designation }}
            @else
                <a href="{{ route('seller.profile.index') }}" class="text-decoration-none">Add Title</a>
            @endif
        </p>
    </div>
    <div class="menu-group">
        <ul class="list-group">
            <li class="list-group-item p-0 border-0 mb10">
                <a href="{{ route('seller.dashboard.index') }}" class="btn btn-light pl35 w-100 rounded-0 border-0 {{ Request::is('seller/dashboard') ? 'active' : '' }}">Dashboard</a>
            </li>
            <li class="list-group-item p-0 border-0 mb10">
                <a href="{{ route('seller.profile.index') }}" class="btn btn-light pl35 w-100 rounded-0 border-0 {{ Request::is('seller/profile') ? 'active' : '' }}">Profile</a>
            </li>
            <li class="list-group-item p-0 border-0 mb10">
                <a href="{{ route('seller.product.index') }}" class="btn btn-light pl35 w-100 rounded-0 border-0 {{ Request::is('seller/products') ? 'active' : '' }}">Products</a>
            </li>
            <li class="list-group-item p-0 border-0 mb10">
                <a href="javascript:void();" class="btn btn-light pl35 w-100 rounded-0 border-0 {{ Request::is('seller/orders') ? 'active' : '' }}">Orders</a>
            </li>
            <li class="list-group-item p-0 border-0 mb10">
                <a href="javascript:void();" class="btn btn-light pl35 w-100 rounded-0 border-0 {{ Request::is('seller/withdraw') ? 'active' : '' }}">Withdraw</a>
            </li>
            <li class="list-group-item p-0 border-0 mb10">
                <a href="javascript:void();" class="btn btn-light pl35 w-100 rounded-0 border-0 {{ Request::is('seller/settings') ? 'active' : '' }}">Settings</a>
            </li>
            <li class="list-group-item p-0 border-0" style="top: 190px">
                <a href="{{ route('seller.logout') }}" class="btn btn-light pl35 w-100 rounded-0 border-0" onclick="event.preventDefault(); document.getElementById('vendor-logout-form').submit();">Logout</a>
                <form id="vendor-logout-form" action="{{ route('seller.logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>
        </ul>
    </div>
</div>
