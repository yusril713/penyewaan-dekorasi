@extends('layouts.admin')
@section('title')
    History Transaksi
@endsection
@section('breadcumbs')
    Layouts /
@endsection
@section('content')
<div class="card card-body">
    <h4>History Transaksi</h4>
    <hr>
    <div class="row">
        <div class="table-responsive">
            <table style="border: none" class="table table-hover" id="example">
                @php
                    $no = 1;
                @endphp
                <tbody>
                    @foreach ($transactions as $transaction)
                    @php
                        $total = 0;
                    @endphp
                    <tr>
                        <td>{{ $no++ }}.</td>
                        <td>Invoice: {{ $transaction->invoice }}<br>
                            Customer: {{ $transaction->getCustomer->name }}<br>
                            No Hp: {{ $transaction->getCustomer->phone }}<br>
                            Alamat: {{ $transaction->getCustomer->address }} <br>
                            <a href="{{ asset('storage/' . $transaction->receipt_of_transfer) }}" target="_blank">Bukti Pembayaran</a>
                        </td>
                        <td>
                        @foreach ($transaction->getTransactionDetails as $detail)
                            {{ $detail->quantity }}
                            {{ $detail->getProduct->name }}
                            ({{ $detail->booking_date }} s.d {{ $detail->return_date }}) <br>
                            @php
                                $total += $detail->price * $detail->quantity * $detail->duration;
                            @endphp
                        @endforeach
                        </td>
                        <td>Rp {{ number_format($total) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
