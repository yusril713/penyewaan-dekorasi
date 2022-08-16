@extends('layouts.admin')
@section('title')
    Laporan Pembayaran
@endsection
@section('breadcumbs')
    Layouts /
@endsection
@section('content')
<div class="card card-body">
    <h4 style="font-size: 18pt">Laporan Pembayaran</h4>
    <hr>
    <div class="row">
        <div class="col-12">
            <div class="table-responsive">
                <table class="table table-hover" id="example">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Invoice</th>
                            <th>Customer</th>
                            <th>Lokasi</th>
                            <th>Total Pembayaran</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transactions as $transaction)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $transaction->invoice }}</td>
                                <td>{{ $transaction->getCustomer->name }}</td>
                                <td>{{ $transaction->getCustomer->address }}</td>
                                @php
                                    $total = 0;
                                @endphp
                                @foreach ($transaction->getTransactionDetails as $detail)
                                    @php
                                        $total += ($detail->price * $detail->quantity * $detail->duration);
                                    @endphp
                                @endforeach
                                <td>{{ number_format($total) }}</td>
                                <td>
                                    <a href="{{ route('transaction.paymentReport.print', [$transaction->id]) }}" class="btn btn-primary btn-sm">Print</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
