@extends('layout.admin')

@section('title', 'edit Category')

@section('breadcrumb')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item active"><a href="{{ route('catagories.index')}}"> Products</a></li>
    <li class="breadcrumb-item active">edit</li>
</ol>
@endsection
@section('content')
<form action="{{route('catagories.update',$category->id)}}" method="post" enctype="multipart/form-data">
    @csrf
    @method('put')
    @include('admin.categories._form',[
    'buttun' =>'Update',
    ])
</form>

@endsection