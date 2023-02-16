@extends('layout.admin')

@section('title', 'Create New Category')

@section('breadcrumb')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="#">{{__('Home')}}</a></li>
    <li class="breadcrumb-item active"><a href="{{ route('catagories.index')}}">{{__('Category')}}</a></li>
    <li class="breadcrumb-item active">{{__('Create')}}</li>
</ol>
@endsection
@section('content')
<form action="{{route('catagories.store')}}" method="post" enctype="multipart/form-data">
    @csrf
    @include('admin.categories._form',[
    'buttun'=>'Add',
    ])
</form>

@endsection