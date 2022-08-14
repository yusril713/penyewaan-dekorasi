@extends('layouts.global')

@section('title')
    Carts
@endsection

@section('content')
<div class="container mt-5">
    <div class="row">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="d-flex justify-content-center">
            <h4>PEMBAYARAN</h4>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-8 row">
                <div class="col-md-3">Invoice</div>
                <div class="col-md-9">: {{ $transaction->invoice }}</div>
            </div>
            <div class="col-md-8 row">
                <div class="col-md-3">Pelanggan</div>
                <div class="col-md-9">: {{ $transaction->getCustomer->name }}</div>
            </div>
            <div class="col-md-8 row">
                <div class="col-md-3">Status Konfirmasi</div>
                <div class="col-md-9">: {{ $transaction->status }}</div>
            </div>
        </div>
        <div class="row">
            <div class="table-responsive">
                <table class="table table-hover">
                    <tr>
                        <th style="text-align: center">No</th>
                        <th style="text-align: center">Produk</th>
                        <th style="text-align: center">Harga</th>
                        <th style="text-align: center">Qty</th>
                        <th style="text-align: center">Durasi</th>
                        <th style="text-align: right">Total</th>
                    </tr>
                    <tbody>
                        @php
                            $no = 1;
                            $total = 0;
                        @endphp
                        @foreach ($transaction['getTransactionDetails'] as $item)
                            @php
                                $total += $item->price * $item->quantity * $item->duration;
                            @endphp
                            <tr>
                                <td style="text-align: center">{{ $no++ }}</td>
                                <td style="text-align: left">{{ $item['getProduct']->name }}</td>
                                <td style="text-align: right">{{ number_format($item->price) }}</td>
                                <td style="text-align: center">{{ $item->quantity }}</td>
                                <td style="text-align: center">{{ $item->duration }}</td>
                                <td style="text-align: right">{{ number_format($item->price * $item->quantity * $item->duration) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="5">TOTAL BAYAR</td>
                            <td style="text-align: right">Rp {{ number_format($total) }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <!-- Button trigger modal -->
        <div class="d-flex justify-content-end mb-5">
            <button type="button" class="btn btn-primary" data-toggle="modal" id="showModal">
                Upload Bukti Pembayaran
            </button>
        </div>


        <!-- Modal -->
        <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Bukti Pembayaran</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('checkout.receiptOfTransfer', [$transaction->id]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="">Upload bukti pembayaran</label>
                                <input type="file" name="image" id="" class="form-control">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" id="closeModal">Close</button>
                            <button type="submit" class="btn btn-primary">Upload</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function() {
        $('#showModal').click(function() {
            $('#staticBackdrop').modal('show');
        });

        $('#closeModal').click(function() {
            $('#staticBackdrop').modal('hide');
        });
    });
</script>
@endsection
