@extends('layout.admin')

@section('title', 'Create New Role')

@section('breadcrumb')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item active"><a href="{{ route('roles.index')}}"> Roles</a></li>
    <li class="breadcrumb-item active">Create</li>
</ol>
@endsection
@section('content')
<form action="{{route('roles.store')}}" method="post" enctype="multipart/form-data">
    @csrf
    @include('admin.roles._form',[
    'buttun'=>'Add',
    ])
</form>

@endsection
