@extends('layouts.auth')
@section('title')
    BOOKStore | Masuk
@endsection
@section('content')
    <div class="container position-absolute top-50 start-50 translate-middle">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card p-3 shadow-lg">
                    <h2 class="text-center mb-4 mt-2 text-primary fw-bold"><a href="{{ route('home') }}" class="nav-link"><i class="fal fa-books"></i> BOOKStore</a></h2>
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="floatingInput" placeholder="name@gmail.com">
                        <label for="floatingInput">Email</label>
                    </div>
                    <div class="form-floating">
                        <input type="password" class="form-control" id="floatingPassword" placeholder="Password">
                        <label for="floatingPassword">Password</label>
                    </div>
                    <button class="btn btn-primary mt-4 mb-3 p-3"><i class="fal fa-sign-in"></i> Masuk</button>
                    <p class="text-center">Belum mendaftar? <a href="{{ route('register') }}">Daftar</a></p>
                    <div class="divider "><span>atau</span></div>
                    <a href="" class="btn btn-light p-3 mb-3"><i class="fab fa-google-plus-g text-danger"></i> Masuk
                        dengan Google</a>
                </div>
            </div>
        </div>
    </div>
@endsection
