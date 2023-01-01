@extends('layout.admin')

@section('title', 'edit Product')

@section('breadcrumb')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item active"><a href="{{ route('products.index')}}"> Products</a></li>
    <li class="breadcrumb-item active">edit</li>
</ol>
@endsection
@section('content')
<form action="{{route('products.update',$product->id)}}" method="post" enctype="multipart/form-data">
    @csrf
    @method('put')
    @include('admin.products._form',[
    'buttun' =>'Update',
    ])
</form>

@endsection
