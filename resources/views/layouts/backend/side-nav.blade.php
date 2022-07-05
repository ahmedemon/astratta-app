<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link text-center" href="/">
            <i class="fas fa-home"></i>
            <span>Astratta</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link text-white" href="{{ route('admin.dashboard.index') }}">
            <i class="fas fa-square text-white"></i>
            <span class="text-white">Dashboard</span>
        </a>
        <hr class="sidebar-divider d-none d-md-block">
        <a class="nav-link {{ Request::is('admin/sellers*') ? '' : 'collapsed' }}" href="javascript:void();" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
            <i class="fas fa-fw fa-cog"></i>
            <span>Sellers</span>
        </a>
        <div id="collapseOne" class="collapse {{ Request::is('admin/sellers*') ? 'show' : '' }}" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('admin.seller.index') }}">Sellers</a>
                <a class="collapse-item" href="{{ route('admin.seller.request') }}">Seller Request</a>
                <a class="collapse-item" href="{{ route('admin.seller.rejected') }}">Rejected Sellers</a>
            </div>
        </div>
        <hr class="sidebar-divider d-none d-md-block">
        <a class="nav-link {{ Request::is('admin/products*') ? '' : 'collapsed' }}" href="javascript:void();" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Products</span>
        </a>
        <div id="collapseTwo" class="collapse {{ Request::is('admin/products*') ? 'show' : '' }}" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('admin.product.request') }}">Product Request</a>
                <a class="collapse-item" href="{{ route('admin.product.index') }}">Approved Products</a>
                <a class="collapse-item" href="{{ route('admin.product.rejected') }}">Rejected Products</a>
                <a class="collapse-item" href="{{ route('admin.product.soldOut') }}">Sold Out Products</a>
            </div>
        </div>
        <hr class="sidebar-divider d-none d-md-block">
        <a class="nav-link" href="{{ route('admin.category.index') }}">
            <i class="fas fa-fw fa-cog"></i>
            <span>Categories</span>
        </a>
    </li>


    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline mt-5">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
