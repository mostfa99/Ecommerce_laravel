@extends('layout.admin');
@section('title')
{{$title}} <a href="{{ route('catagories.create')}}"> Create</a>
@endsection
@section('breadcrumb')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item active"> Categories</li>
</ol>
@endsection
@section('content')

<table class="table">
    <thead>
        <tr>
            <th>loop</th>
            <th>ID</th>
            <th>Name</th>
            <th>Slug</th>
            <th>Paretn id </th>
            <th>Status </th>
            <th>Create At</th>
        </tr>
    </thead>
    <tbody>

        @foreach($categories as $catagory)
        <tr>
            <!-- to do loop number  -->
            <td>{{ $loop->first? 'First' :($loop->last? 'Last' : $loop->iteration) }}</td>
            <td>{{$catagory->id}}</td>
            <td>{{ $catagory->name }}</td>
            <td>{{ $catagory->slug }}</td>
            <td>{{ $catagory->parent_name }}</td>
            <td>{{ $catagory->status }}</td>
            <td>{{ $catagory->created_at }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
