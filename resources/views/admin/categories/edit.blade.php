@extends('layout.admin')

@section('title', 'edit Category')

@section('breadcrumb')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item"> <a href="#">Categories</a></li>
    <li class="breadcrumb-item active">edit</li>
</ol>
@endsection
@section('content')
<form action="{{route('catagories.update',$category->id)}}" method="post">
    @csrf
    @method('put')
    <div class="form-group">
        <label for=""> Category Name</label>
        <input type="text" class="form-control" name="name" value="{{$category->name}}">
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
        <textarea class="form-control" name="descraption"> {{$category->descraption}}</textarea>
    </div>
    <div class="form-group">
        <label for=""> Image</label>
        <input type="file" class="form-group" name="image">
    </div>
    <div class="form-group">
        <label for="status">Status </label>
        <div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="status" value="active" id="status-active"
                    @if($category->status == 'active') checked @endif>
                <label class="form-check-label" for="status-active">
                    Active
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="status" value="draft" id="status-draft"
                    @if($category->status == 'draft') checked @endif>
                <label class="form-check-label" for="status-draft">
                    Draft
                </label>
            </div>
        </div>

    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary"> Save</button>
    </div>
</form>

@endsection