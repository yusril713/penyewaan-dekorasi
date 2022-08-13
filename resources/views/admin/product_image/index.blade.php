@extends('layouts.admin')
@section('title')
    {{ $product->name }}
@endsection
@section('breadcumbs')
    {{ $product->name }} /
@endsection
@section('content')
    <div class="card card-body">
        <h4>{{ $product->name }}</h4>
        <div class="d-flex justify-content-end">
            <a href="
                @if ($product->category == "DEKORASI")
                    {{ route('decor.manage.detail.create', [$product->id]) }}
                @else
                    {{ route('furnish.manage.detail.create', [$product->id]) }}
                @endif
                " class="btn btn-primary btn-sm">Create</a>
        </div>
        <hr>
        <div class="table-responsive">
            <table id="example" class="table table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Image</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $no = 1; @endphp
                    @foreach ($images as $row)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td><img src="{{ asset('storage/' . $row->image) }}" alt="" width="200" class="img-fluid"></td>
                            <td>
                                <form action="
                                    @if ($product->category == "DEKORASI")
                                        {{ route('decor.manage.detail.destroy', [$product->id, $row->id]) }}
                                    @else
                                        {{ route('furnish.manage.detail.destroy', [$product->id, $row->id]) }}
                                    @endif"
                                    method="post"
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
