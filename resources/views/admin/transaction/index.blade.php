@extends('layouts.admin')
@section('title')
    Transaksi
@endsection
@section('breadcumbs')
    Layouts /
@endsection
@section('content')
<div class="card card-body">
    <h4>Daftar Transaksi</h4>
    <hr>
    <div class="row">
        <div class="table-responsive">
            <table style="border: none" class="table table-hover" id="example">
                <thead>
                    <tr>
                        <th colspan="3"></th>
                        <th>Konfirmasi</th>
                    </tr>
                </thead>
                @php
                    $no = 1;
                @endphp
                <tbody>
                    @foreach ($transactions as $transaction)
                    <tr>
                        <td>{{ $no++ }}.</td>
                        <td>Invoice: {{ $transaction->invoice }}<br>
                            Customer: {{ $transaction->getCustomer->name }}<br>
                            No Hp: {{ $transaction->getCustomer->phone }}<br>
                            Alamat: {{ $transaction->getCustomer->address }}
                        </td>
                        <td>
                        @foreach ($transaction->getTransactionDetails as $detail)
                            {{ $detail->quantity }}
                            {{ $detail->getProduct->name }}
                            ({{ $detail->booking_date }} s.d {{ $detail->return_date }}) <br>
                        @endforeach
                        </td>
                        <td>
                            @if (is_null($transaction->status_loan))
                                <form action="{{ route('transaction.borrowed', [$transaction->id]) }}" method="post" onsubmit="return confirm('Yakin ingin mengubah status transaksi menjadi dipinjam?')">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btm btn-primary btn-sm">Dipinjam</button>
                                </form>
                            @else
                                @if ($transaction->status_loan == Transaction::BORROWED)
                                    <form action="{{ route('transaction.returned', [$transaction->id]) }}" method="post" onsubmit="return confirm('Yakin ingin mengubah status transaksi menjadi dikembalikan?')">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btm btn-danger btn-sm">Dikembalikan</button>
                                    </form>
                                @endif
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
