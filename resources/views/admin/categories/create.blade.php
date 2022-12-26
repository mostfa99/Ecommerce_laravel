@extends('layout.admin')

@section('title', 'Create New Category')

@section('breadcrumb')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item"> <a href="#">Categories</a></li>
    <li class="breadcrumb-item active">Create</li>
</ol>
@endsection
@section('content')
<form action="{{route('catagories.store')}}" method="post">
    @csrf
    @include('admin.categories._form',[
    'buttun'=>'Save',
    ])
</form>

@endsection