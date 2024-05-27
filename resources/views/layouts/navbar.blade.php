<nav class="navbar navbar-expand-lg bg-body-tertiary p-3">
    <div class="container-fluid">
        <a class="navbar-brand fs-4 text-light fw-bold" href="{{ route('home') }}"><img src="{{ asset('assets/images/logo.png') }}" class="rounded-circle img-thumbnail" style="width: 60px; height: 60px;" alt=""> Musicall<span class="">Instrument</span></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
            aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasNavbarLabel"><i class="fas fa-music"></i> Musicall<span class="text-warning">Instrument</span>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                    <li class="nav-item">
                        <a class="nav-link fs-6 {{ Request::is('/') ? 'text-white' : 'text-secondary' }}"
                            aria-current="page" href=""><i class="fas fa-home-alt"></i> Home</a>
                    </li>
                    @auth
                        <li class="nav-item">
                            <a class="nav-link fs-6 {{ Request::is('carts') ? 'text-white' : 'text-secondary' }}"
                                aria-current="page" href=""><i class="fal fa-music"></i> Instruments</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fs-6 {{ Request::is('carts') ? 'text-white' : 'text-secondary' }}"
                                aria-current="page" href=""><i class="fal fa-shopping-cart"></i> Carts</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fs-6 {{ Request::is('histories') ? 'text-white' : 'text-secondary' }}"
                                aria-current="page" href=""><i class="fal fa-history"></i> History</a>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle fs-6 {{ Request::is('profile') ? 'text-white' : 'text-secondary' }}"
                                href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user-circle"></i> {{ Auth::user()->username }}
                            </a>
                            <ul class="dropdown-menu">
                                @if (Auth::user()->role === 'admin' || Auth::user()->role === 'seller')
                                    <li><a class="dropdown-item fs-6" href="{{ route('dashboard') }}"><i
                                                class="fal fa-tachometer-alt"></i>
                                            Dashboard</a></li>
                                @else
                                    <li><a class="dropdown-item fs-6" href="#"><i class="fal fa-user"></i> Profile</a></li>
                                @endif
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item fs-6" href="{{ route('logout') }}"><i
                                            class="fal fa-sign-out-alt"></i> Logout</a></li>
                            </ul>
                        </li>
                    @endauth
                    @guest
                        <li class="nav-item">
                            <a class="nav-link active fs-6 text-secondary" aria-current="page" href="{{ route('login') }}"><i
                                    class="fal fa-sign-in-alt"></i> Login</a>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </div>
</nav>
