@extends('layouts.app')
@section('title')
    Home
@endsection
@section('content')
    <div class="container-fluid mt-2">
        <div class="row">
            <div class="col-md-12">
                <div id="carouselExampleIndicators" class="carousel slide">
                    <div class="carousel-indicators">
                        @foreach ($slides as $index => $slide)
                            <button type="button" data-bs-target="#carouselExampleIndicators"
                                data-bs-slide-to="{{ $index }}" class="{{ $index == 0 ? 'active' : '' }}"
                                aria-current="{{ $index == 0 ? 'true' : 'false' }}"
                                aria-label="Slide {{ $index + 1 }}"></button>
                        @endforeach
                    </div>
                    <div class="carousel-inner">
                        @foreach ($slides as $index => $slide)
                            <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                <img src="{{ asset('storage/' . $slide->url_image) }}" class="d-block w-100"
                                    alt="Slide {{ $index + 1 }}">
                            </div>
                        @endforeach
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid mt-4 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-2 mb-3">
                <div class="card text-primary">
                    <img src="{{ asset('assets/images/books/book1.jpg') }}" class="img-cover" alt="">
                    <div class="card-body">
                        JS Khairin
                        <h6>Melangkah</h6>
                        <h6>Rp 79.000</h6>
                    </div>
                </div>
            </div>
            <div class="col-md-2 mb-3">
                <div class="card text-primary">
                    <img src="{{ asset('assets/images/books/book2.jpg') }}" class="img-cover" alt="">
                    <div class="card-body">
                        JS Khairin
                        <h6>Melangkah</h6>
                        <h6>Rp 79.000</h6>
                    </div>
                </div>
            </div>
            <div class="col-md-2 mb-3">
                <div class="card text-primary">
                    <img src="{{ asset('assets/images/books/book3.jpg') }}" class="img-cover" alt="">
                    <div class="card-body">
                        JS Khairin
                        <h6>Melangkah</h6>
                        <h6>Rp 79.000</h6>
                    </div>
                </div>
            </div>
            <div class="col-md-2 mb-3">
                <div class="card text-primary">
                    <img src="{{ asset('assets/images/books/book4.jpg') }}" class="img-cover" alt="">
                    <div class="card-body">
                        JS Khairin
                        <h6>Melangkah</h6>
                        <h6>Rp 79.000</h6>
                    </div>
                </div>
            </div>
            <div class="col-md-2 mb-3">
                <div class="card text-primary">
                    <img src="{{ asset('assets/images/books/book5.jpg') }}" class="img-cover" alt="">
                    <div class="card-body">
                        JS Khairin
                        <h6>Melangkah</h6>
                        <h6>Rp 79.000</h6>
                    </div>
                </div>
            </div>
            <div class="col-md-2 mb-3">
                <div class="card text-primary">
                    <img src="{{ asset('assets/images/books/book2.jpg') }}" class="img-cover" alt="">
                    <div class="card-body">
                        JS Khairin
                        <h6>Melangkah</h6>
                        <h6>Rp 79.000</h6>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-3">
                <a href="" class="text-center btn btn-light form-control rounded-5 mt-3">Tampilkan Semua <i
                        class="fal fa-arrow-right fa-sm"></i></a>
            </div>
        </div>
    </div>
@endsection
