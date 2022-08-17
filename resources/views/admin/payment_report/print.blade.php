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
    <table class="table table-bordered" style="margin-top: 20px">
        <tr>
            <th>No</th>
            <th>Invoice</th>
            <th>Nominal</th>
        </tr>
        <tbody>
            @php
                $totalTransactions = 0;
            @endphp
            @foreach ($transactions as $transaction)
            @php
                $total = 0;
            @endphp
            <tr>
                <td>{{ $no++ }}.</td>
                <td>Invoice: {{ $transaction->invoice }}
                </td>
                @foreach ($transaction->getTransactionDetails as $detail)
                    @php
                        $total += $detail->price * $detail->quantity * $detail->duration;
                    @endphp
                @endforeach
                <td>Rp {{ number_format($total) }}</td>
            </tr>
            @php
                $totalTransactions += $total;
            @endphp
            @endforeach
        </tbody>
    </table>
    <br>
    <div style="right: 0">
        <p style="text-align: right">Kebumen, {{ \Carbon\Carbon::now()->format('d-m-Y') }}</p> <br><br><br>
        <p style="text-align: right">{{ $name->name }}</p>
    </div>
</body>
</html>
