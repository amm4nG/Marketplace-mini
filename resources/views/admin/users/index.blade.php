@extends('layouts.master.app')
@section('title')
    Users Management
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-600">Manage Users</h1>
        </div>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card p-4 mb-4">
                    <a href="#" data-toggle="modal" data-target="#new-user" class="btn btn-primary mb-4 text-center"
                        style="width: 13rem"><i class="fas fa-plus me-1"></i>Add new user as seller</a>
                    <div class="row">
                        <div class="col-md-3">
                            <label for="filter_role">Filter role</label>
                            <select name="filter_role" class="form-control mb-4" id="filter_role">
                                <option value="">All users</option>
                                <option value="seller">Seller</option>
                                <option value="buyer">Buyer</option>
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
    @include('admin.users.modal')
@endsection
@push('scripts')
    {{ $dataTable->scripts() }}
    <script>
        $(document).ready(function() {
            $('#filter_role').change(function() {
                reloadDataTable();
            })
        })

        function reloadDataTable() {
            let role = $('#filter_role').val();
            let url = "{{ route('users.index') }}";

            window.LaravelDataTables['user-table'].ajax.url(`${url}?role=${role}`)
                .load();
        }
    </script>
@endpush
