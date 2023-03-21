@extends('layout.admin')
@section('title')

<div class="d-flex justify-content-between">
    <h2>Users List</h2>
    <div class="">

    </div>

</div>

@endsection
@section('breadcrumb')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
    <li class="breadcrumb-item active"><a href="{{ route('getUser')}}"> Users</a></li>
</ol>
@endsection
@section('content')

<table class=" table">
    <thead>
        <tr>
            <th>User Name</th>
            <th>User email</th>
            <th>Email verified</th>
            <th>User Type</th>
            <th>Profile Address</th>
            <th>Country name</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($users as $user)
        <tr>
            <!-- to do loop number  -->
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{$user->email_verified }}</td>
            <td>{{ $user->type }}</td>
            <td>{{$user->profile->address }}</td>
            <td>{{$user->country->name }}</td>
        </tr>
        @empty

        <h2>
            non user to display
        </h2>
        @endforelse

    </tbody>
</table>


@endsection