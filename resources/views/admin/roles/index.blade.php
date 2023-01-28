@extends('layout.admin')
@section('title')

<div class="d-flex justify-content-between">
    <h2>Roles List</h2>
    <div class="">
        @can('roles.create')
        <a class="btn btn-sm btn-outline-primary" href="{{route('roles.create')}}">Create</a>
        @endcan
    </div>

</div>

@endsection
@section('breadcrumb')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item active"><a href="{{ route('roles.index')}}"> Roles</a></li>
</ol>
@endsection
@section('content')

<table class=" table">
    <thead>
        <tr>

            <th></th>
            <th>Name</th>
            <th>Create At</th>
            <th></th>
            <th></th>

        </tr>
    </thead>
    <tbody>

        @foreach($roles as $role)
        <tr>
            <!-- to do loop number  -->
            <td><img src="{{ $role->image_url }}" width="60" alt=""></td>
            <td>{{ $role->name }}</td>
            <td>{{ $role->created_at }}</td>
            <td>
                <a href="{{route('roles.edit',$role->id)}}" class="btn btn-sm btn-dark">
                    Edit
                </a>
            </td>
            <td>
                @can('roles.delete')
                <form action="{{route('roles.destroy',$role->id)}}" method="post">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-sm btn-danger"> Delete</button>
                </form>
                @endcan
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<!-- for number of pages  after paginte in controller to display it  -->
{{ $roles->links() }}

@endsection