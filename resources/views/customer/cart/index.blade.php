@extends('layouts.global')

@section('title')
    Carts
@endsection

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="d-flex justify-content-center">
            <h4>CART</h4>
        </div>
        <hr>
        <div class="table-responsive">
            <table class="table table-hover">
                <tr>
                    <th style="text-align: center">No</th>
                    <th style="text-align: center">Produk</th>
                    <th style="text-align: center">Tgl Sewa</th>
                    <th style="text-align: center">Tgl Kembali</th>
                    <th style="text-align: center">Harga</th>
                    <th style="text-align: center">Qty</th>
                    <th style="text-align: center">Durasi</th>
                    <th style="text-align: right">Total</th>
                    <th style="text-align: center">Aksi</th>
                </tr>
                <tbody>
                    @php
                        $no = 1;
                        $total = 0;
                    @endphp
                    @if (Session::get('cart'))
                        @foreach (Session::get('cart') as $id => $details)
                            @php
                                $total += ($details['quantity'] * $details['duration'] * $details['price']);
                            @endphp
                            <tr data-id="{{ $id }}">
                                <td style="text-align: center">{{ $no++ }}</td>
                                <td style="text-align: left"><a href="{{ route('product.detail', [$id]) }}">{{ $details['name'] }}</a></td>
                                <td style="text-align: center">{{ $details['booking_date'] }}</td>
                                <td style="text-align: center">{{ $details['return_date'] }}</td>
                                <td style="text-align: center">{{ number_format($details['price']) }}</td>
                                <td style="text-align: center">{{ $details['quantity'] }}</td>
                                <td style="text-align: center">{{ $details['duration'] }}</td>
                                <td style="text-align: right;">{{ number_format($details['quantity'] * $details['duration'] * $details['price']) }}</td>
                                <td style="text-align: center"><button class="btn btn-link remove-from-cart" type="button"><i class="fa fa-trash-o"></i></a></td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="7">TOTAL PEMBAYARAN</th>
                        <th style="text-align: right">Rp {{ number_format($total) }}</th>
                        <th></th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <div class="d-flex justify-content-end mb-5">
            <a class="btn btn-primary">BOOK NOW</a>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $(".remove-from-cart").click(function (e) {
        e.preventDefault();

        var ele = $(this);

        if(confirm("Are you sure want to remove?")) {
            $.ajax({
                url: '{{ route('remove.from.cart') }}',
                method: "DELETE",
                data: {
                    _token: '{{ csrf_token() }}',
                    id: ele.parents("tr").attr("data-id")
                },
                success: function (response) {
                    window.location.reload();
                }
            });
        }
    });
</script>
@endsection
