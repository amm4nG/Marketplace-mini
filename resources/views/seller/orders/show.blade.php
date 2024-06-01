@extends('layouts.master.app')
@section('title')
    Order Detail
@endsection
@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-600"><a href="{{ route('seller.orders.index') }}"><i
                        class="fas fa-arrow-left text-gray-600"></i></a> Order Detail</h1>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card p-4">
                    <div class="row">
                        <div class="col-md-3">
                            <p>Name : {{ $order->user->profile->name }}</p>
                            <p style="margin-top: -13px;">Ordered At : <span
                                    class="badge text-bg-info p-2">{{ $order->ordered_at }}</span></p>
                            <p style="margin-top: -13px;">No. Handphone : {{ $order->user->profile->no_handphone }}</p>
                            <p style="margin-top: -13px;">Shipping Address : {{ $order->user->profile->address }}</p>
                            <p style="margin-top: -13px;">Status : <span
                                    class="badge text-bg-info p-2">{{ $order->payment->status }}</span></p>
                        </div>
                        <div class="col-md-9">
                            <div class="table-responsive">
                                <table class="table table-sm text-end table-striped">
                                    <thead>
                                        <tr>
                                            <th>Instrument</th>
                                            <th>Quantity</th>
                                            <th>Unit Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $totalPayment = 0;
                                        @endphp
                                        @foreach ($order->detailOrder as $ord)
                                            @php
                                                $totalPayment += $ord->instrument->price * $ord->quantity;
                                            @endphp
                                            <tr>
                                                <td>{{ $ord->instrument->name_instrument }}</td>
                                                <td>{{ $ord->quantity }}</td>
                                                <td>Rp. {{ number_format($ord->instrument->price) }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <p class="float-end p-2 badge text-bg-info">Total payment : {{ number_format($totalPayment) }}
                            </p>
                        </div>
                        <div class="col-md-5">
                            <img src="{{ asset('storage/' . $order->payment->proof_payment) }}" class="img-fluid"
                                alt="">
                        </div>
                        <div class="col-md-7">
                            <label for="note">Note</label>
                            <textarea name="note" class="form-control" id="note" cols="30" rows="3"></textarea>
                            <a href="#" onclick="confirmPayment(this)" data-status="paid" data-btn="Yes, approve it!"
                                class="btn btn-primary btn-sm mt-3 {{ $order->payment->status === 'unpaid' ? 'disabled' : '' }}">Approve</a>
                            <a href="#" onclick="confirmPayment(this)" data-status="unpaid" data-btn="Yes, invalid it!"
                                class="btn btn-warning btn-sm mt-3 {{ $order->payment->status === 'unpaid' ? 'disabled' : '' }}">Invalid</a>
                            <a href="#" onclick="confirmPayment(this)" data-status="rejected" data-btn="Yes, reject it!"
                                class="btn btn-danger btn-sm mt-3">Reject</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
