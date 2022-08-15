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
    <hr>
    <div class="row">
        <div class="col-12">
            <form action="{{ route('employee.manage.update', [$employee->id]) }}" method="post">
                @csrf
                @method('PUT')
                <div class="form-group pt-2">
                    <label for="">Nama Lengkap</label>
                    <input type="text" name="name" id="" class="form-control" value="{{ $employee->name }}" required>
                </div>

                <div class="form-group pt-2">
                    <label for="">Jenis Kelamin</label>
                    <select name="gender" id="" class="form-control" required>
                        <option value="">Pilih</option>
                        <option value="Laki-laki" {{ $employee->gender == "Laki-laki" ? 'selected' : '' }}>Laki-laki</option>
                        <option value="Perempuan" {{ $employee->gender == "Perempuan" ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>

                <div class="form-group pt-2">
                    <label for="">No Hp</label>
                    <input type="text" name="phone" id="" class="form-control" value="{{ $employee->phone }}" required>
                </div>

                <div class="form-group pt-2">
                    <label for="">Alamat</label>
                    <textarea name="address" class="form-control" required>{{ $employee->address }}</textarea>
                </div>
                <hr>
                <button class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
</div>
@endsection
