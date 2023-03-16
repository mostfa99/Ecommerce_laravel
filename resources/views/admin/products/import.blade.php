@extends('layout.admin')

@section('title', 'Create New Product')

@section('breadcrumb')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item active"><a href="{{ route('products.index')}}"> Products</a></li>
    <li class="breadcrumb-item active">Import Products</li>
</ol>
@endsection
@section('content')
<form action="{{route('products.import')}}" method="post" enctype="multipart/form-data">
    @csrf
    <!-- Image -->
    <div class="form-group">
        <label for=""> Import Products</label>
        <input type="file" class="form-control @error('file') is-invalid @enderror" name="file">
        @error('file')
        <p class="invalid-feedback">{{$message}}</p>
        @enderror()
    </div>
    <div class="form-group"><button type="submit">
            Import
        </button></div>
</form>

@endsection