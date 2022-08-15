@extends('layouts.admin')
@section('title')
    Employees
@endsection
@section('breadcumbs')
    Layouts /
@endsection
@section('content')
<div class="card card-body">
    <h4>Data Employees</h4>
    <div class="d-flex justify-content-end">
        <a href="{{ route('employee.manage.create') }}" class="btn btn-primary btn-sm">Create</a>
    </div>
    <hr>
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
                @foreach ($employees as $employee)
                    <tr>
                        <td>{{ $no++ }}.</td>
                        <td>{{ $employee->name }}</td>
                        <td>{{ $employee->getUser->email }}</td>
                        <td>{{ $employee->gender }}</td>
                        <td>{{ $employee->phone }}</td>
                        <td>{{ $employee->address }}</td>
                        <td>
                            <a href="{{ route('employee.manage.edit', [$employee->id]) }}" class="btn btn-primary btn-sm">Eidt</a>
                            <form action="{{ route('employee.resetPassword', [$employee->user_id]) }}" method="post" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm">Reset Password</button>
                            </form>
                            <form action="{{ route('employee.manage.destroy', [$employee->id]) }}" method="post" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
