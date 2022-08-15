<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use PDF;
use Illuminate\Http\Request;

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
            'title' => 'Laporan Transaksi ' . $request->startDate . ' - ' . $request->endDate,
            'transactions' => $transactions
        ];

        $pdf = PDF::loadView('admin.report.print', $data);

        return $pdf->download('LaporanTransaksi-' . $request->startDate . '-' . $request->endDate);
    }
}
