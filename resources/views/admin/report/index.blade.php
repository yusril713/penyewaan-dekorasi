@extends('layouts.admin')
@section('title')
    Laporan Transaksi
@endsection
@section('breadcumbs')
    Layouts /
@endsection
@section('content')
<div class="card card-body">
    <h4 style="font-size: 18pt">Laporan Transaksi</h4>
    <hr>
    <div class="row">
        <div class="col-12">
            <form action="{{ route('transaction.report.print') }}" method="get">
                @csrf
                <div class="form-group row">
                    <div class="col-md-2">
                        <label for="">Start Date</label>
                        <input type="date" name="startDate" id="" class="form-control">
                    </div>
                    <div class="col-md-2">
                        <label for=>End Date</label>
                        <input type="date" name="endDate" id="" class="form-control">
                    </div>
                </div>
                <hr>
                <button type="submit" class="btn btn-primary">Print</button>
            </form>
        </div>
    </div>
</div>
@endsection
