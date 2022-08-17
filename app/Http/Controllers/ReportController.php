<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Transaction;
use App\Models\TransactionDetails;
use Carbon\Carbon;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function index()
    {
        return view('admin.report.index');
    }

    public function print(Request $request)
    {
        $transactions = Transaction::with('getTransactionDetails.getProduct', 'getCustomer')
            ->whereBetween('created_at', [$request->startDate, $request->endDate])
            ->where('status_loan', '=', Transaction::RETURNED)
            ->get();

        $data = [
            'title' => 'Laporan Transaksi ' . $this->format($request->startDate) . ' s.d ' . $this->format($request->endDate),
            'transactions' => $transactions,
            'name' => Employee::where('user_id', '=', Auth::user()->id)->first()
        ];

        $pdf = PDF::loadView('admin.report.print', $data)->setPaper('a4', 'landscape');

        return $pdf->download('LaporanTransaksi-' . $request->startDate . '-' . $request->endDate);
    }

    public function format($date)
    {
        return \Carbon\Carbon::createFromFormat('Y-m-d', $date)->format('d-m-Y');
    }

    public function indexPaymentReport()
    {
        return view('admin.payment_report.index', [
            "transactions" => Transaction::with('getCustomer', 'getTransactionDetails')->orderBy('created_at', 'desc')->get()
        ]);
    }

    public function printPaymentReport()
    {
        $transactions = Transaction::with('getCustomer', 'getTransactionDetails')->get();
        $pdf = PDF::loadView('admin.payment_report.print', [
            'transactions' => $transactions,
            'name' => Employee::where('user_id', '=', Auth::user()->id)->first()
        ]);

        return $pdf->download('Laporan Pembayaran ' . Carbon::now()->format('dmY'));
    }
}
