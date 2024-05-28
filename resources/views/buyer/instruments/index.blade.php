@extends('layouts.app')
@section('title')
    Instrument
@endsection
@section('content')
    <div class="container-fluid mt-3 p-3">
        <div class="row justify-content-center">
            <h2 class="text-primary mb-4"><i class="fas fa-music"></i> Instruments Music</h2>
            @forelse ($instruments as $instrument)
            <div class="col-md-2 mb-3">
                <div class="card shadow text-primary rounded-2">
                    <img src="{{ asset('storage/' . $instrument->instrumentImages->first()->image) }}" class="img-cover"
                        alt="">
                    <div class="card-footer text-center">
                        <h6 class="mt-2">{{ $instrument->name_instrument }}</h6>
                        <h6>Rp. {{ number_format($instrument->price) }}</h6>
                        <p>{{ ($instrument->description) ? Str::limit($instrument->description, 12, '...') : '-' }}</p>
                        <a href="" class="btn btn-primary mb-2 rounded-5 p-2 ps-3 pe-3"><i class="fas fa-cart-plus"></i>
                            Add to cart</a>
                        <a href="{{ route('/.instruments.show', $instrument->id) }}" class="btn btn-secondary mb-2 rounded-5 p-2 ps-3 pe-3">Detail <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
            @empty
            @endforelse
        </div>
    </div>
@endsection