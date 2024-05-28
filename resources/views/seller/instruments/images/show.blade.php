@extends('layouts.master.app')
@section('title')
    Instrument Image Management
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-11">
                <div class="card p-4 mb-4">
                    <h4 class="mb-4 text-capitalize text-secondary"><a href="{{ route('seller.instruments.index') }}"><i
                                class="fas fa-arrow-left text-secondary fa"></i></a> Manage Instrument Images -
                        {{ $instrument->name_instrument }}</h4>
                    <a href="#" data-toggle="modal" data-target="#new-image" class="btn btn-primary mb-4 text-center"
                        style="width: 12rem"><i class="fas fa-plus me-1"></i> Add Image</a>
                    <div class="table-responsive">
                        {{ $dataTable->table(['class' => 'table table-striped table-sm']) }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('seller.instruments.images.modal')
@endsection
@push('scripts')
    {{ $dataTable->scripts() }}
@endpush
