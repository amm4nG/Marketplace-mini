<nav class="navbar navbar-expand-lg bg-body-tertiary p-3">
    <div class="container-fluid">
        <a class="navbar-brand fs-4 text-light fw-bold" href="{{ route('home') }}"><i class="fas fa-music"></i> MusicallInstrument</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
            aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasNavbarLabel"><i class="fas fa-music"></i> MusicallInstrument</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                    @auth
                        <li class="nav-item">
                            <a class="nav-link fs-6 {{ Request::is('carts') ? 'text-white' : 'text-secondary' }}"
                                aria-current="page" href=""><i class="fal fa-shopping-cart"></i> Keranjang</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fs-6 {{ Request::is('histories') ? 'text-white' : 'text-secondary' }}"
                                aria-current="page" href=""><i class="fal fa-history"></i> Histori</a>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle fs-6 {{ Request::is('profile') ? 'text-white' : 'text-secondary' }}"
                                href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user-circle"></i> {{ Auth::user()->username }}
                            </a>
                            <ul class="dropdown-menu">
                                @if (Auth::user()->role === 'admin' || Auth::user()->role === 'seller')
                                    <li><a class="dropdown-item" href="{{ route('dashboard') }}"><i class="fal fa-tachometer-alt"></i>
                                            Dashboard</a></li>
                                @else
                                    <li><a class="dropdown-item" href="#"><i class="fal fa-user"></i> Profil</a></li>
                                @endif
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item text-danger" href="{{ route('logout') }}"><i
                                            class="fal fa-sign-out"></i> Keluar</a></li>
                            </ul>
                        </li>
                    @endauth
                    @guest
                        <li class="nav-item">
                            <a class="nav-link active fs-6 text-white" aria-current="page" href="{{ route('login') }}"><i
                                    class="fal fa-sign-in"></i> Login</a>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </div>
</nav>
