@extends('layout.admin')

@section('title', 'Create New Product')

@section('breadcrumb')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item active"><a href="{{ route('products.index')}}"> Products</a></li>
    <li class="breadcrumb-item active">Create</li>
</ol>
@endsection
@section('content')
<form action="{{route('products.store')}}" method="post" enctype="multipart/form-data">
    @csrf
    @include('admin.products._form',[
    'buttun'=>'Add',
    ])
</form>

@endsection