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
            <form action="{{ route('employee.manage.store') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="">Email</label>
                    <input type="email" name="email" id="" class="form-control" required>
                </div>

                <div class="form-group pt-2">
                    <label for="">Password</label>
                    <input type="password" name="password" id="" required class="form-control" required>
                </div>

                <div class="form-group pt-2">
                    <label for="">Nama Lengkap</label>
                    <input type="text" name="name" id="" class="form-control" required>
                </div>

                <div class="form-group pt-2">
                    <label for="">Jenis Kelamin</label>
                    <select name="gender" id="" class="form-control" required>
                        <option value="">Pilih</option>
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                </div>

                <div class="form-group pt-2">
                    <label for="">No Hp</label>
                    <input type="text" name="phone" id="" class="form-control" required>
                </div>

                <div class="form-group pt-2">
                    <label for="">Alamat</label>
                    <textarea name="address" class="form-control" required></textarea>
                </div>

                <div class="form-group pt-2">
                    <label for="">Role</label>
                    <select name="role" id="" class="form-control" required>
                        <option value="0">Admin</option>
                        <option value="1">Owner</option>
                    </select>
                </div>
                <hr>
                <button class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
</div>
@endsection
