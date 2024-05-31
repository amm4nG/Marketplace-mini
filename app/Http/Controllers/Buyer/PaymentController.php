<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PaymentController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'proof_payment' => ['required', 'mimes:png,jpg,jpeg'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->errors(),
            ]);
        }
        try {
            $payment = Payment::find($request->id);
            if ($payment->proof_payment) {
                Storage::disk('public')->delete($payment->proof_payment);
            }
            $path = $request->file('proof_payment')->store('proof-payments', 'public');
            $payment->proof_payment = $path;
            $payment->paid_at = Carbon::now();
            $payment->status = 'pending';
            $payment->save();
            return response()->json([
                'status' => 200,
                'message' => 'Uploaded proof payment successful',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 500,
                'message' => $th->getMessage(),
            ]);
        }
    }
}
