<?php

namespace App\Http\Controllers\Buyer;

use App\DataTables\Buyer\CartDataTable;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    public function index(CartDataTable $dataTable)
    {
        return $dataTable->render('buyer.carts.index');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'quantity' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->errors(),
            ]);
        }

        try {
            $cart = new Cart();
            $cart->user_id = Auth::user()->id;
            $cart->instrument_id = $request->instrument_id;
            $cart->quantity = $request->quantity;
            $cart->save();
            return response()->json([
                'status' => 200,
                'message' => 'Add instrument to cart successfully',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 500,
                'message' => $th->getMessage(),
            ]);
        }
    }
}
