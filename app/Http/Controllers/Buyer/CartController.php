<?php

namespace App\Http\Controllers\Buyer;

use App\DataTables\Buyer\CartDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index(CartDataTable $dataTable){
        return $dataTable->render('buyer.carts.index');
    }
}
