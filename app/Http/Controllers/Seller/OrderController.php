<?php

namespace App\Http\Controllers\Seller;

use App\DataTables\Seller\OrderDataTable;
use App\Http\Controllers\Controller;
use App\Models\OrderInstrument;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(OrderDataTable $dataTable)
    {
        $dataTable = new OrderDataTable(request()->get('status'));
        return $dataTable->render('seller.orders.index');
    }

    public function show($id)
    {
        $order = OrderInstrument::find($id);
        return view('seller.orders.show', compact('order'));
    }
}
