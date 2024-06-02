<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PaymentController extends Controller
{
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'note' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->errors(),
            ]);
        }

        try {
            $payment = Payment::find($id);
            $payment->status = $request->status;
            $payment->note = $request->note;
            $payment->update();
            return response()->json([
                'status' => 200,
                'message' => 'Updated status payment successfull',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 500,
                'message' => $th->getMessage(),
            ]);
        }
    }
}
