<nav class="navbar navbar-expand-lg p-2">
    <div class="container-fluid">
        <a class="navbar-brand fs-3 text-primary fw-bold" href="{{ route('home') }}"><i class="fal fa-books"></i> BOOKStore</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
            aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav ms-auto">
                <a class="nav-link active fs-5 text-primary" aria-current="page" href="{{ route('login') }}"><i class="fal fa-sign-in"></i> Masuk</a>
            </div>
        </div>
    </div>
</nav>