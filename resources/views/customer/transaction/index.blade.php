@extends('layouts.global')

@section('title')
    Transaksi Saya
@endsection

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="d-flex justify-content-center">
            <h4>Transaksi Saya</h4>
        </div>
        <hr>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="table-responsive">
                <table class="table table-hover">
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
                            Tgl Pesan: {{ $transaction->created_at }} <br>
                            <a href="{{ asset('storage/' . $transaction->receipt_of_transfer) }}" target="_blank">Bukti Pembayaran</a><br>
                            Status Konfirmasi: {!! $transaction->status == "<span class='badge bg-danger'>UNCONFIRMED</span>" ? 'Belum Dikonfirmasi' : ($transaction->status == "<span class='badge bg-danger'>CANCELED</span>" ? "Dibatalkan" : "<span class='badge bg-success'>Telah Dikonfirmasi</span>") !!} <br>
                            Status Sewa: {!!  is_null($transaction->status_loan) ? "<span class='badge bg-danger'>Menunggu Konfirmasi Admin</span>" : ($transaction->status_loan == "BORROWED" ? "<span class='badge bg-danger'>Sedang Dipinjam</span>" : "<span class='badge bg-success'>Telah Dikembalikan/Selesai</span>") !!}
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
</div>
@endsection
