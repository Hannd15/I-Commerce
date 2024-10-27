<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;

class PaymentController extends Controller
{
    public function createPayment(Request $request)
    {
        // Validate the request data
        $request->validate([
            'id_user' => 'required',
            'id_status' => 'required',
            'image' => 'required',
        ]);

        // Create the payment if it doesn't exist
        Payment::create([
            'id_user' => $request->user,
            'id_status' => $request->status,
            'image' => $request->image,
        ]);

        return redirect()->back()->with('success', 'Payment created successfully');
    }
    public function deletePayment(Request $request){
        $request->validate([
            'id' => 'required',
        ]);
        $payment = Payment::find($request->id);
        if ($payment){
            $payment->delete();
            return redirect()->back()->with('success', 'Payment deleted successfully');
        }
        return redirect()->back()->with('error', 'Payment not found');
    }
    public function updatePayment(Request $request){
        $request->validate([
            'id' => 'required',
            'status' => 'required',
        ]);
        $payment = Payment::find($request->id);
        if ($payment){
            $payment->status = $request->status;
            $payment->image = $request->image;
            $payment->save();
            return redirect()->back()->with('success', 'Payment updated successfully');
        }
        return redirect()->back()->with('error', 'Payment not found');
    }
    public function getPayment(Request $request){ // Falta añadir la vista para mostrar el payment, sin json xd, se puso por la autocompleción
        $request->validate([
            'id' => 'required',
        ]);
        $payment = Payment::find($request->id);
        if ($payment){
            return response()->json($payment);
        }
        return response()->json(['error' => 'Payment not found'], 404);
    }
}
