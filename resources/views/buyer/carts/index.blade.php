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
                            @if (Auth::user()->profile->name && Auth::user()->profile->no_handphone && Auth::user()->profile->address)
                                <p class="float-end"><span class="badge text-bg-secondary py-2">Shipping Address</span> :
                                    {{ Auth::user()->profile->address }}</p>
                            @else
                                <a href="{{ route('profile.index') }}" class="btn btn-warning btn-sm mb-3">Please complete
                                    your profile such as name, address, cellphone number before checkout!</a>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <p class="float-end badge text-bg-secondary py-2">Total Payment: Rp. <span
                                    id="total-price">0</span>
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            @if (Auth::user()->profile->name && Auth::user()->profile->no_handphone && Auth::user()->profile->address)
                                <a href="#" onclick="order()" id="checkout"
                                    class="disabled btn btn-primary float-end">Checkout</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('buyer.carts.modal')
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
                    var id = $(this).val().split(',')[0];
                    var instrumentId = $(this).val().split(',')[1];
                    var quantity = $(this).val().split(',')[2];
                    var totalPrice = $(this).val().split(',')[3];
                    checkedValues.push({
                        id: id,
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
            $('#checkout').addClass("disabled");
            let csrfToken = document.querySelector('meta[name="csrf-token"]').content;
            fetch('order/store', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(form)
                })
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                    if (data.status === 200) {
                        Swal.fire({
                            title: "Good job!",
                            text: data.message,
                            icon: "success",
                            isConfirmed: true,
                            allowOutsideClick: false,
                            allowEscapeKey: false
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = '/orders';
                            }
                        });
                    }
                    $('#checkout').addClass("disabled");
                })
                .catch(e => {
                    console.log(e);
                    $('#checkout').addClass("disabled");
                })
        } 
    </script>
@endpush
