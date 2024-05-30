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
                    <div class="row mt-4">
                        <div class="col-md-6"></div>
                        <div class="col-md-6 text-end">
                            @if (Auth::user()->profile->address)
                                <p class="float-end">Address: Desa Sabang-Subik, Kec. Balanipa, Kab. Polewali Mandar, Prov.
                                    Sulawesi Barat</p>
                            @else
                            <a href="" class="btn btn-warning btn-sm mb-3">Please complete the profile before checkout!</a>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <p class="float-end badge text-bg-secondary py-2">Total Payment: Rp. <span
                                    id="total-price">0</span></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <a href="#" onclick="order()" id="checkout"
                                class="disabled btn btn-primary float-end">Checkout</a>
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
        var form = []
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
                    var totalPrice = $(this).val().split(',')[2];
                    checkedValues.push({
                        instrumentId: instrumentId,
                        quantity: quantity,
                        totalPrice: totalPrice
                    });
                });

                if (checkedValues.length > 0) {
                    $('#checkout').removeClass("disabled");
                } else {
                    $('#checkout').addClass("disabled");
                }

                form = checkedValues
                var total = 0
                form.forEach(element => {
                    total += parseFloat(element.totalPrice)
                });
                $('#total-price').text(total.toLocaleString('id-ID'))
            }

        });

        function order() {
            Swal.fire({
                title: "Good job!",
                text: 'testing',
                icon: "success",
                isConfirmed: true,
                allowOutsideClick: false,
                allowEscapeKey: false
            })
        }
    </script>
@endpush
