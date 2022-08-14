@extends('layouts.admin')
@section('title')
    Rincian Pesanan
@endsection
@section('breadcumbs')
    Layouts /
@endsection
@section('content')
<div class="card card-body">
    <h4>Rincian Pesanan</h4>
    <hr>
    <div class="row">
        <div class="col-2">
            Invoice
        </div>
        <div class="col-10">
            {{ $transaction->invoice }}
        </div>

        <div class="row">
            <div class="col-2">
                Customer
            </div>
            <div class="col-10">
                {{ $transaction->getCustomer->name }}
            </div>
        </div>

        <div class="row">
            <div class="col-2">
                Tanggal Pesan
            </div>
            <div class="col-10">
                {{ $transaction->created_at }}
            </div>
        </div>

        <div class="row">
            <div class="col-2">
                Status Pembayaran
            </div>
            <div class="col-10">
                @if ($transaction->payment_status === "UNPAID")
                    <span class="badge bg-danger">
                        {{ $transaction->payment_status }}
                    </span>
                    @if ($transaction->receipt_of_transfer)
                        <a href="{{ asset('storage/' . $transaction->receipt_of_transfer) }}" target="_blank"> Bukti Transfer</a>
                    @else
                        Belum mengupload bukti transfer
                    @endif
                @else
                    <span class="badge bg-success">
                        {{ $transaction->payment_status }}
                    </span>
                @endif
            </div>
        </div>

        <div class="row">
            <div class="col-2">
                Status Pesanan
            </div>
            <div class="col-10">
                {{ $transaction->status }}
            </div>
        </div>
        <hr>
    </div>
    <div class="row">
        @php
            $total = 0;
        @endphp
        @foreach ($transaction->getTransactionDetails as $detail)
            @php
                $total += $detail->price * $detail->quantity * $detail->duration;
            @endphp
            <div class="row">
                <div class="col-2">
                    <img src="{{ asset('storage/' . $detail->getProduct->getImage->image) }}" alt="" class="img-fluid">
                </div>
                <div class="col-7">
                    <div class="row">
                        <div class="col-4">
                            Nama
                        </div>
                        <div class="col-8">
                            {{ $detail->getProduct->name }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            Jumlah
                        </div>
                        <div class="col-8">
                            {{ $detail->quantity }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            Tgl Pinjam
                        </div>
                        <div class="col-8">
                            {{ $detail->booking_date }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            Tgl Kembali
                        </div>
                        <div class="col-8">
                            {{ $detail->return_date }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            Durasi Pinjam
                        </div>
                        <div class="col-8">
                            {{ $detail->duration }}
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="d-flex justify-content-end">
                        Rp {{ number_format($detail->price * $detail->quantity * $detail->duration) }}
                    </div>
                </div>
            </div>
        @endforeach
        <hr>
        <div class="row">
            <div class="d-flex justify-content-end">
                Rp {{ number_format($total) }}
            </div>
        </div>
        <hr>

        <div class="row">
            <div class="col-12">
                <form action="{{ route('booking.confirm', [$transaction->id]) }}" method="post" class="d-inline" onsubmit="return confirm('Yakin ingin meng-konfirmasi pesanan {{ $transaction->invoice }}?')">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="btn btn-primary">Konfirmasi Pesanan</button>
                </form>
                <form action="{{ route('booking.cancel', [$transaction->id]) }}" method="post" class="d-inline"
                    onsubmit="return confirm('Yakin ingin meng-konfirmasi pesanan {{ $transaction->invoice }}?')">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="btn btn-danger">Batalkan Pesanan</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
