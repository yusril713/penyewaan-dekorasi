@extends('layouts.admin')
@section('title')
    Create
@endsection
@section('breadcumbs')
    Tenda Dekorasi /
@endsection
@section('content')
    <div class="card card-body">
        <h4>Create</h4>
        <form action="{{ route('decor.manage.update', [$product->id]) }}" method="post" enctype="multipart/form-data"
            onsubmit="return confirm('Are you sure want to update this data?')">
            @csrf
            @method('PUT')
            <input type="hidden" name="category" value="DEKORASI">
            <div class="form-group pt-2">
                <label for="">Nama</label>
                <input type="text" name="name" id="" class="form-control"
                    placeholder="Masukkan nama tenda dekorasi" value="{{ $product->name }}" required>
            </div>

            <div class="form-group pt-2">
                <label for="">Jumlah</label>
                <input type="text" name="stock" id="" class="form-control"
                    placeholder="Masukkan jumlah tenda dekorasi" value="{{ $product->stock }}" required>
            </div>

            <div class="form-group pt-2">
                <label for="">Warna</label>
                <input type="text" name="color" id="" class="form-control"
                    placeholder="Masukkan warna tenda dekorasi" value="{{ $product->color }}" required>
            </div>

            <div class="form-group pt-2">
                <label for="">Harga</label>
                <input type="text" name="price" id="" class="form-control"
                    placeholder="Masukkan harga sewa per hari tenda dekorasi" value="{{ $product->price }}" required>
            </div>

            <div class="form-group pt-2">
                <label for="">Deskripsi</label>
                <textarea name="description" id="" class="form-control" rows="10" placeholder="Input deskripsi tenda (opsional)">{{ $product->description }}</textarea>
            </div>

            <div class="d-flex justify-content-end pt-2">
                <button type="submit" class="btn btn-primary btn-sm text-right">Submit</button>
            </div>
        </form>
    </div>
@endsection
