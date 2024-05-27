    <!-- Sidebar -->
    <ul class="navbar-nav sidebar sidebar-dark accordion" style="background-color: #38527E" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/') }}">
            <div class="sidebar-brand-icon rotate-n-15">
                <img src="{{ asset('assets/images/logo.png') }}" style="width: 50px; height: 50px;" class="rounded-circle img-thumbnail" alt="">
            </div>
            <div class="sidebar-brand-text mx-2"> M<sup class="text-warning">instrument</sup></div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item {{ Request::is('dashboard') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('dashboard') }}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            menu
        </div>
        <li class="nav-item {{ Request::is('instruments') || Request::is('images*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('instruments.index') }}">
                <i class="fas fa-fw fa-music"></i>
                <span>Instruments</span></a>
        </li>
        <li class="nav-item {{ Request::is('categories') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('categories.index') }}">
                <i class="fas fa-fw fa-tag"></i>
                <span>Categories</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="">
                <i class="fas fa-fw fa-shopping-cart"></i>
                <span>Orders</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">
        <div class="sidebar-heading">
            settings
        </div>
        <li class="nav-item {{ Request::is('slides') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('slides.index') }}">
                <i class="fas fa-fw fa-image"></i>
                <span>Slide Show</span></a>
        </li>
        @if (Auth::user()->role === 'admin')
            <li class="nav-item {{ Request::is('users') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('users.index') }}">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Users</span></a>
            </li>
        @endif

        <hr class="sidebar-divider d-none d-md-block">
        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>
    </ul>
    <!-- End of Sidebar -->
