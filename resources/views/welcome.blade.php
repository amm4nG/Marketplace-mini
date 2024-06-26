@extends('layouts.app')
@section('title')
    Home
@endsection
@section('content')
    <div class="container-fluid mt-2">
        <div class="row">
            <div class="col-md-12">
                <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
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
                            <div class="carousel-item {{ $index == 0 ? 'active' : '' }}" data-bs-interval="3000">
                                <img src="{{ asset('storage/' . $slide->url_image) }}" class="d-block w-100"
                                    alt="Slide {{ $index + 1 }}">
                            </div>
                        @endforeach
                    </div>
                    @if ($slides->count() > 0)
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon bg-secondary" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon bg-secondary" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    @else
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid mt-2 p-3">
        <div class="row justify-content-center">
            @forelse ($instruments as $instrument)
                <div class="col-md-2 mb-3">
                    <div class="card shadow text-primary rounded-2">
                        <img src="{{ asset('storage/' . $instrument->instrumentImages->first()->image) }}" class="img-cover"
                            alt="">
                        <div class="card-footer text-center">
                            <h6 class="mt-2">{{ $instrument->name_instrument }}</h6>
                            <h6>Rp. {{ number_format($instrument->price) }}</h6>
                            <p>{{ $instrument->description ? Str::limit($instrument->description, 12, '...') : '-' }}</p>
                            <a href="{{ route('/.instruments.show', $instrument->id) }}"
                                class="btn btn-secondary mb-2 rounded-5 p-2 ps-4 pe-4">Detail <i
                                    class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <h1 class="mt-4 text-primary mb-5 text-center"><i class="fas fa-search"></i> Data Empty</h1>
            @endforelse
            @if ($instruments->count() > 0)
                <div class="row justify-content-center">
                    <div class="col-md-3">
                        <a href="{{ route('/.instruments.index') }}"
                            class="text-center btn btn-light form-control rounded-5 mt-3 p-3">Show All <i
                                class="fal fa-arrow-right fa-sm"></i></a>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
