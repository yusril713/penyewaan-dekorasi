<!DOCTYPE html>
<html>
<head>
    <title>Laravel 9 Generate PDF Example - ItSolutionStuff.com</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <center><h4>{{ $title }}</h4></center>
    <hr>

    <table class="table table-bordered" style="margin-top: 20px">
        <tr>
            <th>No</th>
            <th>Transaksi</th>
            <th>Detail Transaksi</th>
            <th>Harga Sewa</th>
        </tr>
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

</body>
</html>
