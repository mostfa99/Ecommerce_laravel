@extends('layout.admin');

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
    <div class="form-group">
        <label for=""> Category Name</label>
        <input type="text" class="form-control" name="name">
    </div>
    <div class="form-group">
        <label for=""> Parent</label>
        <select name="parent_id" id="parent_id" class="form-control">
            <option value="">No Parent</option>
            @foreach ($parents as $parent )
            <option value="{{$parent->id}}">{{$parent->name}} </option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for=""> Descraption</label>
        <textarea class="form-control" name="descraption"> </textarea>
    </div>
    <div class="form-group">
        <label for=""> Image</label>
        <input type="file" class="form-group" name="image">
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary"> Save</button>
    </div>
</form>

@endsection
