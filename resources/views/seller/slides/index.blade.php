@extends('layouts.master.app')
@section('title')
    Slides Management
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-11">
                <div class="card p-4 mb-4">
                    <a href="#" data-toggle="modal" data-target="#new-slide" class="btn btn-primary mb-4 text-center"
                        style="width: 10rem"><i class="fas fa-plus me-1"></i> New Slide</a>
                    <div class="table-responsive">
                        {{ $dataTable->table(['class' => 'table table-striped table-sm']) }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('seller.slides.modal')
@endsection
@push('scripts')
    {{ $dataTable->scripts() }}
@endpush
