<?php

namespace App\Http\Controllers\Buyer;

use App\DataTables\Buyer\CartDataTable;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Instrument;
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
        $checkInstrument = Cart::where('instrument_id', $request->instrument_id)
            ->where('user_id', Auth::user()->id)
            ->first();
        if ($checkInstrument) {
            return response()->json([
                'status' => 422,
                'errors' => [
                    'instrumentAlready' => [
                        0 => 'Instrument already in cart',
                    ],
                ],
            ]);
        }

        $validator = Validator::make($request->all(), [
            'quantity' => ['required', 'integer', 'min:1'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->errors(),
            ]);
        }

        try {
            $instrument = Instrument::find($request->instrument_id);
            if ($instrument->stock < $request->quantity) {
                return response()->json([
                    'status' => 422,
                    'errors' => [
                        'quantity' => [
                            0 => 'Insufficient stock',
                        ],
                    ],
                ]);
            }
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

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'quantity' => ['required', 'integer', 'min:1'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->errors(),
            ]);
        }
        try {
            $instrument = Instrument::find($request->instrument_id);
            if ($instrument->stock < $request->quantity) {
                return response()->json([
                    'status' => 422,
                    'errors' => [
                        'quantity' => [
                            0 => 'Insufficient stock',
                        ],
                    ],
                ]);
            }
            $cart = Cart::find($id);
            $cart->quantity = $request->quantity;
            $cart->update();
            return response()->json([
                'status' => 200,
                'message' => 'Updated successfull',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 500,
                'message' => $th->getMessage(),
            ]);
        }
    }

    public function destroy($id)
    {
        $cart = Cart::findOrFail($id);
        $cart->delete();
        return back()->with([
            'message' => 'Deleted successful',
        ]);
    }
}
