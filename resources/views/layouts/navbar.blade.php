<nav class="navbar navbar-expand-lg bg-body-tertiary p-2">
    <div class="container-fluid">
        <a class="navbar-brand fs-3 text-white fw-bold" href="{{ route('home') }}"><img
                src="{{ asset('assets/images/title.png') }}" style="width: 55px; height: 55px;" class="me-2"
                alt="">BOOKStore</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
            aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fal fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav ms-auto">
                @guest
                    <a class="nav-link active fs-5 text-white" aria-current="page" href="{{ route('login') }}"><i
                            class="fal fa-sign-in"></i> Masuk</a>
                @endguest
                @auth
                    <a class="nav-link fs-5 {{ Request::is('belanja') ? 'text-white' : 'text-secondary'}}" aria-current="page" href=""><i
                            class="fal fa-shopping-bag"></i> Belanja</a>
                    <a class="nav-link fs-5 {{ Request::is('keranjang') ? 'text-white' : 'text-secondary'}}" aria-current="page" href=""><i
                            class="fal fa-shopping-cart"></i> Keranjang</a>
                    <a class="nav-link fs-5 {{ Request::is('histori') ? 'text-white' : 'text-secondary'}}" aria-current="page" href=""><i
                            class="fal fa-history"></i> Histori</a>
                    <a class="nav-link fs-5 {{ Request::is('profil') ? 'text-white' : 'text-secondary'}}" aria-current="page" href=""><i
                            class="fas fa-user-circle"></i> Profil</a>
                @endauth
            </div>
        </div>
    </div>
</nav>
