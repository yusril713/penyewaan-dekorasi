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
    <h4>Invoice #{{ $transaction->invoice }}</h4>

    <table style="width: 50%; border:none;">
        <tr>
            <td>Nama Customer</td>
            <td>: {{ $transaction->getCustomer->name }}</td>
        </tr>
        <tr>
            <td>Tanggal Mulai Acara</td>
            <td>: {{ $start_date[0]->booking_date }}</td>
        </tr>
        <tr>
            <td>Tanggal Selesai Acara</td>
            <td>: {{ $end_date[0]->return_date }}</td>
        </tr>
    </table>
    @php
        $total = 0;
    @endphp
    @foreach ($transaction->getTransactionDetails as $detail)
        @php
            $total += ($detail->price * $detail->quantity * $detail->duration)
        @endphp
    @endforeach
    <table class="table table-bordered" style="margin-top: 20px">
        <tr>
            <th>No</th>
            <th>Keterangan</th>
            <th>Nominal</th>
            <th>Status</th>
        </tr>
        <tbody>
            <tr>
                <td>1.</td>
                <td>Pembayaran Invoice {{ $transaction->invoice }}</td>
                <td>{{ number_format($total) }}</td>
                <td>{{ $transaction->payment_status }}</td>
            </tr>
        </tbody>
    </table>

    <p><b>Total Pembayaran: Rp {{ number_format($total) }}</b></p>
    <br>
    <div style="right: 0">
        <p style="text-align: right">Kebumen, {{ \Carbon\Carbon::now()->format('d-m-Y') }}</p> <br><br><br>
        <p style="text-align: right">{{ $name->name }}</p>
    </div>
</body>
</html>
