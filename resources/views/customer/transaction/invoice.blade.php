<!DOCTYPE html>
<html>
<head>
    <title>Laravel 9 Generate PDF Example - ItSolutionStuff.com</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <header>
        <center>
            <h4>Classica Sound Invoice</h4>
            <p>Alamat: Karangjambu, Kecamatan Sruweng, Kabupaten Kebumen, Jawa Tengah 54362. <br>

                Telpon: 0811263557 E-mail: teguhsimon@gmail.com</p>
        </center>
        <hr style="color: black">
    </header>
    <table style="border: none; width:50%">
        <tr>
            <td>Invoice</td>
            <td>: {{ $transaction->invoice }}</td>
        </tr>
        <tr>
            <td>Tgl Pesan</td>
            <td>: {{ $transaction->created_at }}</td>
        </tr>
        <tr>
            <td>Status Pesanan</td>
            <td>: {{ $transaction->status }}</td>
        </tr>
    </table>

    <table class="table table-bordered" style="margin-top: 20px">
        <thead>
            <tr>
                <th>No</th>
                <th>Produk</th>
                <th>Tgl Pinjam/Kembali</th>
                <th>Durasi Pnjm</th>
                <th>Qty</th>
                <th>Harga</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @php
                $total = 0;
            @endphp
            @foreach ($transaction->getTransactionDetails as $detail)
                @php
                    $total += ($detail->quantity * $detail->duration * $detail->price);
                @endphp
                <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>{{ $detail->getProduct->name }}</td>
                    <td>{{ $detail->booking_date }}/{{ $detail->return_date }}</td>
                    <td>{{ $detail->duration }} Hari</td>
                    <td>{{ $detail->quantity }}</td>
                    <td>{{ number_format($detail->price) }}</td>
                    <td>{{ number_format($detail->quantity * $detail->duration * $detail->price) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <p><b>Total Pembayaran: Rp {{ number_format($total) }}</b></p>
    <div style="right: 0">
        <p style="text-align: right">Kebumen, {{ \Carbon\Carbon::now()->format('d-m-Y') }}</p> <br><br><br>
        <p style="text-align: right">{{ $transaction->getCustomer->name }}</p>
    </div>
</body>
</html>
