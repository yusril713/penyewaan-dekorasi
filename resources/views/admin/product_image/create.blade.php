@extends('layouts.admin')
@section('title')
    Add Image {{ $product->name }}
@endsection
@section('breadcumbs')
    {{ $product->name }} /
@endsection
@section('content')
    <div class="card card-body">
        <h4>Create</h4>
        <form action="
            @if ($product->category == "DEKORASI")
                {{ route('decor.manage.detail.store', [$product->id]) }}
            @else
                {{ route('furnish.manage.detail.store', [$product->id]) }}
            @endif
            " method="post" enctype="multipart/form-data"
            onsubmit="return confirm('Are you sure want to add this data?')">
            @csrf
            <div class="form-group pt-2">
                <label for="">Image</label>
                <input type="file" name="image" id="" class="form-control" required>
            </div>

            <div class="d-flex justify-content-end pt-2">
                <button type="submit" class="btn btn-primary btn-sm text-right">Submit</button>
            </div>
        </form>
    </div>
@endsection
