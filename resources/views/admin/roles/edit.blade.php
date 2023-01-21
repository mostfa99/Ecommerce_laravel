@extends('layout.admin')

@section('title', 'Edit Role')

@section('breadcrumb')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item active"><a href="{{ route('roles.index')}}"> Roles</a></li>
    <li class="breadcrumb-item active">edit</li>
</ol>
@endsection
@section('content')
<form action="{{route('roles.update',$role->id)}}" method="post" enctype="multipart/form-data">
    @csrf
    @method('put')
    @include('admin.roles._form',[
    'buttun' =>'Update',
    ])
</form>

@endsection
