<div class="col-md-3 col-lg-3 col-xl-3 col-xxl-3 col-12 side-nav py30 px20 d-lg-block d-xl-block d-xxl-block" id="sideMenuBar">
    <button class="btn btn-outline-danger d-lg-none d-xl-none d-xxl-none" id="closeButton"><i class="fas fa-times"></i></button>
    <div class="vendor-info d-grid justify-content-center align-items-center mb45">
        <img class="vendor-profile-image mx-auto mb20 rounded-circle" src="{{ Auth::guard('seller')->user()->image ? asset('storage/seller/' . Auth::guard('seller')->user()->image) : asset('vendor/images/artist/avatar.svg') }}" alt="" />
        <h1 class="my-0 mb5-i">{{ Auth::guard('seller')->user()->name ?? Auth::guard('seller')->user()->username }}</h1>
        @if (Auth::guard('seller')->user()->is_approved == 0)
            <small class="text-danger">(Account Inactivate)</small>
        @endif
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
                <a href="{{ Auth::guard('seller')->user()->is_approved ? route('seller.dashboard.index') : 'javascript::void();' }}" class="btn btn-light pl35 w-100 rounded-0 border-0 {{ Request::is('seller/dashboard*') ? 'active' : '' }} deactivated">Dashboard</a>
            </li>
            <li class="list-group-item p-0 border-0 mb10">
                <a href="{{ Auth::guard('seller')->user()->is_approved ? route('seller.profile.index') : 'javascript::void();' }}" class="btn btn-light pl35 w-100 rounded-0 border-0 {{ Request::is('seller/profile*') ? 'active' : '' }} deactivated">Profile</a>
            </li>
            <li class="list-group-item p-0 border-0 mb10">
                <a href="{{ Auth::guard('seller')->user()->is_approved ? route('seller.product.index') : 'javascript::void();' }}" class="btn btn-light pl35 w-100 rounded-0 border-0 {{ Request::is('seller/products*') ? 'active' : '' }} deactivated">Products</a>
            </li>
            <li class="list-group-item p-0 border-0 mb10">
                <a href="{{ Auth::guard('seller')->user()->is_approved ? route('seller.orders.index') : 'javascript::void();' }}" class="btn btn-light pl35 w-100 rounded-0 border-0 {{ Request::is('seller/orders*') ? 'active' : '' }} deactivated">Orders</a>
            </li>
            <li class="list-group-item p-0 border-0 mb10">
                <a href="{{ Auth::guard('seller')->user()->is_approved ? route('seller.refund.index') : 'javascript::void();' }}" class="btn btn-light pl35 w-100 rounded-0 border-0 {{ Request::is('seller/refunds*') ? 'active' : '' }} deactivated">Refunds</a>
            </li>
            <li class="list-group-item p-0 border-0 mb10">
                <a href="{{ Auth::guard('seller')->user()->is_approved ? route('seller.withdraw.index') : 'javascript::void();' }}" class="btn btn-light pl35 w-100 rounded-0 border-0 {{ Request::is('seller/withdraw*') ? 'active' : '' }} deactivated">Withdraw</a>
            </li>
            <li class="list-group-item p-0 border-0 mb10">
                <a href="{{ Auth::guard('seller')->user()->is_approved ? route('seller.setting.index') : 'javascript::void();' }}" class="btn btn-light pl35 w-100 rounded-0 border-0 {{ Request::is('seller/settings*') ? 'active' : '' }} deactivated">Settings</a>
            </li>
            <li class="list-group-item p-0 border-0">
                <a href="{{ route('seller.logout') }}" class="btn btn-light pl35 w-100 rounded-0 border-0" onclick="event.preventDefault(); document.getElementById('vendor-logout-form').submit();">
                    <i class="fas fa-sign-in-alt"></i> Logout
                </a>
                <form id="vendor-logout-form" action="{{ route('seller.logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>
        </ul>
    </div>
</div>
