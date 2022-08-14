<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Exception;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index($id)
    {
        return view('customer.checkout.index', [
            'transaction' => Transaction::with('getTransactionDetails.getProduct', 'getCustomer')->find($id)
        ]);
    }

    public function uploadReceiptOfTransfer(Request $request, $id)
    {
        try {
            $transaction = Transaction::find($id);
            $transaction->setReceiptOfTransfer($request);
            $transaction->save();
            return redirect()->back()->with('success', "Bukti pembayaran invoice " . $transaction->invoice . " berhasil di upload");
        } catch(Exception $e) {
            return $e->getMessage();
        }

    }
}
