@extends('layouts.admin')
@section('title')
    Tenda Dekorasi
@endsection
@section('breadcumbs')
    Layouts /
@endsection
@section('content')
    <div class="card card-body">
        <h4>Tenda Dekorasi</h4>
        <div class="d-flex justify-content-end">
            <a href="{{ route('decor.manage.create') }}" class="btn btn-primary btn-sm">Create</a>
        </div>
        <hr>
        <div class="table-responsive">
            <table id="example" class="table table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Stok</th>
                        <th>Warna</th>
                        <th>Harga</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $no = 1; @endphp
                    @foreach ($products as $row)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $row->name }}</td>
                            <td>{{ $row->stock }}</td>
                            <td>{{ $row->color }}</td>
                            <td>{{ number_format($row->price) }}</td>
                            <td><a href="{{ route('decor.manage.detail.index', [$row->id]) }}" class="btn btn-success btn-sm">View</a>
                                <a href="{{ route('decor.manage.edit', [$row->id]) }}" class="btn btn-primary btn-sm">Edit</a>
                                <form action="{{ route('decor.manage.destroy', [$row->id]) }}" method="post"
                                    class="d-inline"
                                    onsubmit="return confirm('Are you sure want to remove this data?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
