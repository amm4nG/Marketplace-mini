@extends('layouts.app')
@section('title')
    Datail Instrument
@endsection
@section('content')
    <div class="container mt-4 mb-5">
        <div class="row mb-2">
            <h3 class="text-primary"><a href="{{ route('/.instruments.index') }}"><i
                        class="fas fa-arrow-left text-primary"></i></a> Detail Instrument</h3>
            @guest
                <div class="col-md-12 mt-3">
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>Please login </strong>for add instrument to cart
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            @endguest
        </div>
        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card p-3">
                    <div class="row">
                        <div class="col-md-2 mb-4">
                            <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
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
                                        <div class="carousel-item {{ $index == 0 ? 'active' : '' }}" data-bs-interval="7000">
                                            <img src="{{ asset('storage/' . $image->image) }}" class="d-block w-100"
                                                alt="Slide {{ $index + 1 }}">
                                        </div>
                                    @endforeach
                                </div>
                                <button class="carousel-control-prev" type="button"
                                    data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon bg-secondary" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button"
                                    data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                                    <span class="carousel-control-next-icon bg-secondary" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                        </div>
                        <div class="col-md-10 ps-4 text-primary">
                            <h3>{{ $instrument->name_instrument }}</h3>
                            <h6 class="mt-3">Rp. {{ number_format($instrument->price) }}</h6>
                            <h6>Stock : {{ $instrument->stock }} Unit</h6>
                            <p>{{ $instrument->description }}</p>
                            <a href="#" data-bs-toggle="modal" data-bs-target="#add-cart"
                                class="@if (!Auth::user()) disabled @endif btn btn-primary mb-2 rounded-5 p-2 ps-3 pe-3"><i
                                    class="fas fa-cart-plus"></i>
                                Add to cart
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('buyer.instruments.modal')
@endsection
