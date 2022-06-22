<div class="col-md-3 col-lg-3 col-xl-3 col-xxl-3 col-12 side-nav py30 px20 d-lg-block d-xl-block d-xxl-block" id="sideMenuBar">
    <button class="btn btn-outline-danger d-lg-none d-xl-none d-xxl-none" id="closeButton"><i class="fas fa-times"></i></button>
    <div class="vendor-info d-grid justify-content-center align-items-center mb45">
        <img class="vendor-profile-image mx-auto mb20" src="{{ asset('vendor/images/artist/profile.png') }}" alt="" />
        <h1 class="my-0 mb5-i">{{ Auth::guard('vendor')->user()->name }}</h1>
        <p class="my-0">Abstract Painter</p>
    </div>
    <div class="menu-group">
        <ul class="list-group">
            <li class="list-group-item p-0 border-0 mb10">
                <a href="{{ route('vendor.dashboard.index') }}" class="btn btn-light pl35 w-100 rounded-0 border-0 active">Dashboard</a>
            </li>
            <li class="list-group-item p-0 border-0 mb10">
                <a href="edit-profile.blade.html" class="btn btn-light pl35 w-100 rounded-0 border-0">Profile</a>
            </li>
            <li class="list-group-item p-0 border-0 mb10">
                <a href="products.blade.html" class="btn btn-light pl35 w-100 rounded-0 border-0">Products</a>
            </li>
            <li class="list-group-item p-0 border-0 mb10">
                <a href="javascript:void();" class="btn btn-light pl35 w-100 rounded-0 border-0">Orders</a>
            </li>
            <li class="list-group-item p-0 border-0 mb10">
                <a href="javascript:void();" class="btn btn-light pl35 w-100 rounded-0 border-0">Withdraw</a>
            </li>
            <li class="list-group-item p-0 border-0 mb10">
                <a href="javascript:void();" class="btn btn-light pl35 w-100 rounded-0 border-0">Settings</a>
            </li>
            <li class="list-group-item p-0 border-0" style="top: 190px">
                <a href="{{ route('vendor.logout') }}" class="btn btn-light pl35 w-100 rounded-0 border-0" onclick="event.preventDefault(); document.getElementById('vendor-logout-form').submit();">Logout</a>
                <form id="vendor-logout-form" action="{{ route('vendor.logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>
        </ul>
    </div>
</div>
