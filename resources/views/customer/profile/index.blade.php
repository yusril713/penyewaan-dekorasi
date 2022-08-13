@extends('layouts.global')

@section('title')
    {{ $customer->name }}
@endsection

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="d-flex justify-content-center">
            <h4>{{ $customer->name }}</h4>
        </div>
        <hr>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="card card-body mb-5">
                <div class="d-flex justify-content-center">
                    <h4>Akun saya</h4>
                </div>
                <hr>
                <form action="{{ route('profile.updateProfile', [$customer->id]) }}" method="post" onsubmit="return confirm('Yakin ingin mengupdate profil anda?')">
                    @csrf
                    <div class="form-group row">
                        <label for="" class="col-sm-2">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" name="name" id="" class="form-control" value="{{ $customer->name }}" required>
                        </div>
                    </div>
                    <div class="form-group row pt-3">
                        <label for="" class="col-sm-2">Gender</label>

                        <div class="col-sm-10">
                            <select name="gender" class="form-control" id="" required>
                                <option value="">Pilih</option>
                                <option value="Laki-laki" {{ $customer->gender == "Laki-laki" ? "selected" : "" }}>Laki-laki</option>
                                <option value="Perempuan" {{ $customer->gender == "Perempuan" ? "selected" : "" }}>Perempuan</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row pt-3">
                        <label for="" class="col-sm-2">No Hp</label>
                        <div class="col-sm-10">
                            <input type="text" name="phone" id="" class="form-control" value="{{ $customer->phone }}" required>
                        </div>
                    </div>
                    <div class="form-group row pt-3">
                        <label for="" class="col-sm-2">Alamat</label>
                        <div class="col-sm-10">
                            <textarea name="address" id="" class="form-control" required>{{ $customer->address }}</textarea>
                        </div>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card card-body">
                <div class="d-flex justify-content-center">
                    <h4>Ubah Password</h4>
                </div>
                <hr>
                <form action="{{ route('profile.updatePassword') }}" method="post" onsubmit="return confirm('Yakin ingin mengubah password?')">
                    @csrf
                    <div class="form-group row">
                        <label for="" class="col-sm-2">Password Lama</label>
                        <div class="col-sm-10">
                            <input type="password" name="oldPassword" id="" class="form-control @error('oldPassword') is-invalid @enderror" value="{{ old('oldPassword') }}">
                            @error('oldPassword')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                    </div>
                    <div class="form-group row pt-3">
                        <label for="" class="col-sm-2">Password Baru</label>
                        <div class="col-sm-10">
                            <input type="password" name="newPassword" id="" class="form-control @error('newPassowrd') is-invalid @enderror" value="{{ old('newPassword') }}">
                            @error('newPassword')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row pt-3">
                        <label for="" class="col-sm-2">Konfirmasi Password</label>
                        <div class="col-sm-10">
                            <input type="password" name="passwordConfirmation" id="" class="form-control @error('passwordConformation') is-invalid @enderror" value="{{ old('passwordConfirmation') }}">
                            @error('passwordConfirmation')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
            <hr>
            <div class="d-flex justify-content-end">
                <a class="btn btn-success" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    <i class="bx bx-power-off me-2"></i>
                    <span class="align-middle">Log Out</span>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
