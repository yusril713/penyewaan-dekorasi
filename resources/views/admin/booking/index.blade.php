@extends('layouts.admin')
@section('title')
    Pesanan
@endsection
@section('breadcumbs')
    Layouts /
@endsection
@section('content')
<div class="card card-body">
    <h4>Daftar Pesanan</h4>
    <hr>
    <div class="table-reponsive">
        <table id="example" class="table table-hover">
            <thead>
                <tr>
                    <th>Invoice</th>
                    <th>Customer</th>
                    <th>Tgl Booking</th>
                    <th>Alamat</th>
                    <th>Bukti Pembayaran</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transactions as $transaction)
                    <tr>
                        <td>{{ $transaction->invoice }}</td>
                        <td>{{ $transaction->getCustomer->name }}</td>
                        <td>{{ $transaction->created_at }}</td>
                        <td>{{ $transaction->getCustomer->address }}</td>
                        <td>
                            @if ($transaction->receipt_of_transfer)
                                <a href="{{ asset('storage/' . $transaction->receipt_of_transfer) }}" target="_blank">
                                    Bukti Transfer
                                </a>
                            @else
                                <span class="badge bg-danger">Belum Bayar</span>
                            @endif
                        </td>
                        <td>
                            @if ($transaction->status == "CANCELED" or $transaction->status == "UNCONFIRMED")
                                <span class="badge bg-danger">{{ $transaction->status }}</span>
                            @else

                            @endif
                        </td>
                        <td>
                            <a href="{{ route('booking.show', [$transaction->id]) }}" class="btn btn-primary btn-sm">Rincian</a>
                            <a href="" class="btn btn-danger btn-sm">Batalkan</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
