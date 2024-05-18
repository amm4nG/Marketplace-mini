@extends('layouts.app')
@section('title')
    BOOKStore | Toko Buku Online
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div id="carouselExampleIndicators" class="carousel slide">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                        aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                        aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                        aria-label="Slide 3"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3"
                        aria-label="Slide 4"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="{{ asset('assets/images/slideshow/slide-show-1.jpg') }}" class="d-block w-100 slide-cover"
                            alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('assets/images/slideshow/slide-show-2.jpg') }}" class="d-block w-100 slide-cover"
                            alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('assets/images/slideshow/slide-show-4.jpg') }}" class="d-block w-100 slide-cover"
                            alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('assets/images/slideshow/slide-show-5.jpg') }}" class="d-block w-100 slide-cover"
                            alt="...">
                    </div>
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
    <div class="container-fluid mt-4 mb-5">
        <div class="row">
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
    </div>
@endsection
