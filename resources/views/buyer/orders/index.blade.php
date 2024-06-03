@extends('layouts.app')
@section('title')
    Orders
@endsection
@section('content')
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-warning" role="alert">
                    <h5 class="mb-3"><i class="fal fa-info-circle"></i> Payment Information</h5>
                    Mandiri. 123456789
                    <p>
                        An. Arman
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="container mb-3 mt-2">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card p-4 mb-4">
                    <div class="table-responsive">
                        {{ $dataTable->table(['class' => 'table table-striped table-sm']) }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('buyer.orders.modal')
@endsection
@push('scripts')
    {{ $dataTable->scripts() }}
    <script>
        $(document).ready(function(){
            $('#orderinstrument-table_filter').css('display', 'none');
        });
    </script>
@endpush
