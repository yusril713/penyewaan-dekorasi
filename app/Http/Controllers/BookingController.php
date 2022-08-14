<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        return view('admin.booking.index', [
            'transactions' => Transaction::with('getCustomer')
                ->where('status', '=', Transaction::UNCONFIRMED)
                ->orWhere('status', '=', Transaction::CANCELED)
                ->orWhere('payment_status', '=', Transaction::UNPAID)
                ->orderBy('created_at', 'desc')
                ->get()
        ]);
    }

    public function show($id)
    {
        $transaction = Transaction::with('getTransactionDetails.getProduct.getImage', 'getCustomer')
            ->find($id);
        return view('admin.booking.show', [
            'transaction' => $transaction
        ]);
    }

    public function confirm($id)
    {
        $transaction = Transaction::find($id);
        $transaction->setStatus(Transaction::CONFIRMED);
        $transaction->setPaymentStatus(Transaction::PAID);
        $transaction->save();
        $this->message(true, "Pesanan " . $transaction->invoice . ' berhasil dikonfirmasi', '');
        return redirect()->back();
    }

    public function cancel($id)
    {
        $transaction = Transaction::find($id);
        $transaction->setStatus(Transaction::CANCELED);
        $transaction->save();
        $this->message(true, "Pesanan " . $transaction->invoice . ' berhasil dibatalkan', '');
        return redirect()->back();
    }
}
