<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionDetails;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function index()
    {
        return view('admin.transaction.index', [
            'transactions' => Transaction::with('getTransactionDetails.getProduct', 'getCustomer')
                ->where('status', '=', Transaction::CONFIRMED)
                ->where('payment_status', '=', Transaction::PAID)
                ->where(function($q) {
                    $q->where('status_loan', null)
                      ->orWhere('status_loan', Transaction::BORROWED);
                })
                ->orderBy('created_at', 'desc')
                ->get()
        ]);
    }

    public function borrowed($id) {
        try {
            DB::beginTransaction();
            $transaction = Transaction::find($id);
            $transaction->setLoanStatus(Transaction::BORROWED);
            $transaction->save();

            $details = TransactionDetails::where('transaction_id', '=', $id)->get();
            foreach($details as $detail) {
                $product = Product::find($detail->product_id);
                $product->stock -= $detail->quantity;
                $product->save();
            }

            DB::commit();
            $this->message(true, 'Transaksi dengan invoice ' . $transaction->invoice . ' berhasil dipinjamkan', "");
        } catch (Exception $e) {
            DB::rollBack();
            $this->message(false, "", "Gagal mengubah status transaksi. " . $e->getMessage());
        }

        return redirect()->back();
    }

    public function returned($id) {
        try {
            DB::beginTransaction();
            $transaction = Transaction::find($id);
            $transaction->setLoanStatus(Transaction::RETURNED);
            $transaction->save();

            $details = TransactionDetails::where('transaction_id', '=', $id)->get();
            foreach($details as $detail) {
                $product = Product::find($detail->product_id);
                $product->stock += $detail->quantity;
                $product->save();
            }

            DB::commit();
            $this->message(true, 'Transaksi dengan invoice ' . $transaction->invoice . ' berhasil dikembalikan', "");
        } catch (Exception $e) {
            DB::rollBack();
            $this->message(false, "", "Gagal mengubah status transaksi. " . $e->getMessage());
        }

        return redirect()->back();
    }

    public function history()
    {
        return view('admin.transaction_history.index', [
            'transactions' => Transaction::with('getTransactionDetails.getProduct', 'getCustomer')
                ->where('status_loan', '=', Transaction::RETURNED)
                ->orderBy('created_at', 'desc')
                ->get()
        ]);
    }
}
