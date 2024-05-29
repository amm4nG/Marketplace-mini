@extends('layouts.app')
@section('title')
    Cart
@endsection
@section('content')
    <div class="container mt-4">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 text-primary">Cart</h1>
        </div>
    </div>
    <div class="container mb-3">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card p-4 mb-4">
                    <div class="table-responsive">
                        {{ $dataTable->table(['class' => 'table table-striped table-sm']) }}
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <a href="" id="checkout" class="disabled btn btn-primary mt-4 float-end">Checkout</a>
                        </div>
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
            $('#select-all').on('click', function() {
                var rows = $('#cart-table').DataTable().rows({
                    'search': 'applied'
                }).nodes();
                var isChecked = this.checked;
                $('input[type="checkbox"]', rows).prop('checked', isChecked);
                displayCheckedValues();
            });

            $('#cart-table tbody').on('change', 'input[type="checkbox"]', function() {
                displayCheckedValues();
            });

            function displayCheckedValues() {
                var checkedValues = [];
                $('#cart-table tbody input[type="checkbox"]:checked').each(function() {
                    var instrumentId = $(this).val().split(',')[0];
                    var quantity = $(this).val().split(',')[1];
                    checkedValues.push({
                        instrumentId: instrumentId,
                        quantity: quantity
                    });
                });
                if (checkedValues.length > 0) {
                    $('#checkout').removeClass("disabled");
                }else{
                    $('#checkout').addClass("disabled");
                }
            }
        });
    </script>
@endpush
