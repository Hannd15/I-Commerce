<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;

class PaymentItemController extends Controller
{
    public function getPaymentItems(Request $request){
        $request->validate([
            'id_payment' => 'required',
        ]);
        $payment = Payment::find($request->id_payment);
        if ($payment){
            return response()->json($payment->items);
        }
        return response()->json(['error' => 'Payment not found'], 404);
    }
}
