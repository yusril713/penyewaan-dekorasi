<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;

class UserTransactionController extends Controller
{
    public function index()
    {
        $customer = Customer::where('user_id', '=', Auth::user()->id)->first();
        $transactions = Transaction::with('getTransactionDetails.getProduct.getImage', 'getCustomer')
            ->where('customer_id', $customer->id)
            ->orderBy('created_at', 'desc')
            ->get();
        return view('customer.transaction.index', [
            'transactions' => $transactions
        ]);
    }

    public function print($id)
    {
        $transaction = Transaction::with('getCustomer', 'getTransactionDetails.getProduct')->find($id);
        $data = [
            'title' => 'INVOICE',
            'transaction' => $transaction
        ];

        $pdf = PDF::loadView('customer.transaction.invoice', $data)->setPaper('a4', 'landscape');

        return $pdf->download('Invoice_' . $transaction->invoice);
    }
}
