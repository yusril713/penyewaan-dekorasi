<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function show($id)
    {
        return view('customer.transaction.show');
    }
}
