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
        <form action="{{ route('furnish.manage.store') }}" method="post" enctype="multipart/form-data"
            onsubmit="return confirm('Are you sure want to add this data?')">
            @csrf
            <input type="hidden" name="category" value="PERLENGKAPAN">
            <div class="form-group pt-2">
                <label for="">Nama</label>
                <input type="text" name="name" id="" class="form-control"
                    placeholder="Masukkan nama tenda dekorasi" required>
            </div>

            <div class="form-group pt-2">
                <label for="">Jumlah</label>
                <input type="text" name="stock" id="" class="form-control"
                    placeholder="Masukkan jumlah tenda dekorasi" required>
            </div>

            <div class="form-group pt-2">
                <label for="">Warna</label>
                <input type="text" name="color" id="" class="form-control"
                    placeholder="Masukkan warna tenda dekorasi" required>
            </div>

            <div class="form-group pt-2">
                <label for="">Harga</label>
                <input type="text" name="price" id="" class="form-control"
                    placeholder="Masukkan harga sewa per hari tenda dekorasi" required>
            </div>

            <div class="form-group pt-2">
                <label for="">Image</label>
                <input type="file" name="image" id="" class="form-control" required>
            </div>

            <div class="form-group pt-2">
                <label for="">Deskripsi</label>
                <textarea name="description" id="" class="form-control" rows="10" placeholder="Input deskripsi tenda (opsional)"></textarea>
            </div>

            <div class="d-flex justify-content-end pt-2">
                <button type="submit" class="btn btn-primary btn-sm text-right">Submit</button>
            </div>
        </form>
    </div>
@endsection
