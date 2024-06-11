@extends('layouts.master.app')
@section('title')
    Management Orders
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-600">Orders Instrument</h1>
        </div>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card p-4 mb-4">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="filter_status">Filter status</label>
                            <select name="filter_status" class="form-control mb-4" id="filter_status">
                                <option value="">All status</option>
                                <option value="paid">Paid</option>
                                <option value="unpaid">Unpaid</option>
                                <option value="pending">Pending</option>
                                <option value="rejected">Rejected</option>
                            </select>
                        </div>
                    </div>
                    <div class="table-responsive">
                        {{ $dataTable->table(['class' => 'table table-striped table-sm']) }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    {{ $dataTable->scripts() }}
    <script>
        $(document).ready(function() {
            $('#filter_status').change(function() {
                reloadDataTable();
            })
        })

        function reloadDataTable() {
            let status = $('#filter_status').val();
            let url = "{{ route('seller.orders.index') }}";

            window.LaravelDataTables['orderinstrument-table'].ajax.url(`${url}?status=${status}`)
                .load();
        }
    </script>
@endpush
