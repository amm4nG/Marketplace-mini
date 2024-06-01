<?php

namespace App\Http\Controllers\Buyer;

use App\DataTables\Buyer\OrderDataTable;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Instrument;
use App\Models\OrderDetail;
use App\Models\OrderInstrument;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index(OrderDataTable $dataTable)
    {
        return $dataTable->render('buyer.orders.index');
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $totalPrice = 0;
            foreach ($request->all() as $price) {
                $totalPrice += $price['totalPrice'];
            }

            $userId = Auth::user()->id;
            $orderInstrument = new OrderInstrument();
            $orderInstrument->user_id = $userId;
            $orderInstrument->total_price = $totalPrice;
            $orderInstrument->save();

            foreach ($request->all() as $order) {
                $orderDetail = new OrderDetail();
                $orderDetail->order_id = $orderInstrument->id;
                $orderDetail->instrument_id = $order['instrumentId'];
                $orderDetail->quantity = $order['quantity'];
                $orderDetail->save();

                $cart = Cart::find($order['id']);
                $cart->delete();

                $instrument = Instrument::find($order['instrumentId']);
                $instrument->stock = $instrument->stock - $order['quantity'];
                $instrument->update();
            }

            $payment = new Payment();
            $payment->order_id = $orderInstrument->id;
            $payment->amount = $totalPrice;
            $payment->save();

            DB::commit();
            return response()->json([
                'status' => 200,
                'message' => 'Order successful',
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'status' => 500,
                'message' => $th->getMessage(),
            ]);
        }
    }

    public function detail($id)
    {
        try {
            $instrument = OrderInstrument::find($id);
            $orders = OrderDetail::where('order_id', $id)->with('instrument')->get();
            return response()->json([
                'status' => 200,
                'data' => [
                    'ordered_at' => $instrument->ordered_at,
                    'instruments' => $orders
                ],
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 500,
                'message' => $th->getMessage(),
            ]);
        }
    }
}
