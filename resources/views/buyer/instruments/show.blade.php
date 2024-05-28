@extends('layouts.app')
@section('title')
    Datail Instrument
@endsection
@section('content')
    <div class="container mt-4 mb-5">
        <div class="row">
            <div class="col-md-2">
                <div id="carouselExampleIndicators" class="carousel slide">
                    <div class="carousel-indicators">
                        @foreach ($instrument->instrumentImages as $index => $image)
                            <button type="button" data-bs-target="#carouselExampleIndicators"
                                data-bs-slide-to="{{ $index }}" class="{{ $index == 0 ? 'active' : '' }}"
                                aria-current="{{ $index == 0 ? 'true' : 'false' }}"
                                aria-label="Slide {{ $index + 1 }}"></button>
                        @endforeach
                    </div>
                    <div class="carousel-inner">
                        @foreach ($instrument->instrumentImages as $index => $image)
                            <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                <img src="{{ asset('storage/' . $image->image) }}" class="d-block w-100"
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
            <div class="col-md-10 ps-4">
                <h3>{{ $instrument->name_instrument }}</h3>
                <h6 class="mt-3">Rp. {{ number_format($instrument->price) }}</h6>
                <h6>Stock : {{ $instrument->stock }} Unit</h6>
                <p>{{ $instrument->description }}</p>
                <a href="" class="btn btn-primary mb-2 rounded-5 p-2 ps-3 pe-3"><i class="fas fa-cart-plus"></i>
                    Add to cart</a>
            </div>
        </div>
    </div>
@endsection
