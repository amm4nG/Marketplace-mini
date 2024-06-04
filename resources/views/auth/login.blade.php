@extends('layouts.auth')
@section('title')
    Page Login
@endsection
@section('content')
    <div class="container position-absolute top-50 start-50 translate-middle">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <form action="{{ route('validation.user') }}" method="post">
                    <div class="card p-3 shadow-lg">
                        @csrf
                        <div class="row justify-content-center">
                            <div class="col-md-12 text-center">
                                <img src="{{ asset('assets/images/logo.png') }}" class="rounded-circle"
                                    style="width: 70px; height: 70px;" alt="">
                            </div>
                        </div>
                        <h2 class="text-center mb-4 mt-2 text-primary fw-bold"><a href="{{ route('home') }}"
                                class="nav-link">Musicall<span class="text-warning">Instrument</span></a></h2>
                        @if ($errors->has('message'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ $errors->first('message') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                        <div class="form-floating mb-3">
                            <input type="email" name="email"
                                class="form-control @error('email')
                                is-invalid
                            @enderror"
                                value="{{ old('email') }}" id="floatingInput" placeholder="name@gmail.com">
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <label for="floatingInput">Email</label>
                        </div>
                        <div class="form-floating">
                            <input type="password" name="password"
                                class="form-control @error('password')
                                is-invalid
                            @enderror"
                                id="floatingPassword" placeholder="Password">
                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <label for="floatingPassword">Password</label>
                        </div>
                        <button type="submit" class="btn btn-primary mt-4 mb-3 p-3"><i class="fal fa-sign-in-alt"></i>
                            Login</button>
                        <p class="text-center">Not Registered? <a href="{{ route('register') }}">Register</a></p>
                        <div class="divider "><span>atau</span></div>
                        <a href="{{ route('google.redirect') }}" class="btn btn-light p-3 mb-3"><img
                                src="{{ asset('assets/images/icon/google-removebg-preview.png') }}"
                                style="width: 35px; height: 35px;" alt="">
                            <span class="mt-1">
                                Login With Google
                            </span>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
