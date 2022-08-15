@extends('layouts.admin')
@section('title')
    Customer
@endsection
@section('breadcumbs')
    Layouts /
@endsection
@section('content')
<div class="card card-body">
    <h4>Data Customer</h4>
    <div class="table-responsive">
        <table class="table table-hover" id="example">
            <thead>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Gender</th>
                <th>No. Hp</th>
                <th>Alamat</th>
                <th>Aksi</th>
            </thead>
            <tbody>
                @php
                    $no = 1;
                @endphp
                @foreach ($customers as $customer)
                    <tr>
                        <td>{{ $no++ }}.</td>
                        <td>{{ $customer->name }}</td>
                        <td>{{ $customer->getUser->email }}</td>
                        <td>{{ $customer->gender }}</td>
                        <td>{{ $customer->phone }}</td>
                        <td>{{ $customer->address }}</td>
                        <td>
                            <form action="{{ route('customer.resetPassword', [$customer->user_id]) }}" method="post">
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm">Reset Password</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
