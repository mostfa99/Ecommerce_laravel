@extends('layout.admin')
@section('title')

<div class="d-flex justify-content-between">
    <h2>Admins List</h2>
    <div class="">

    </div>

</div>

@endsection
@section('breadcrumb')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
    <li class="breadcrumb-item active"><a href="{{ route('getUser')}}"> Admins</a></li>
</ol>
@endsection
@section('content')

<table class=" table">
    <thead>
        <tr>
            <th>User Name</th>
            <th>User username</th>
            <th>User email</th>
            <th>Email verified</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($admins as $admin)
        <tr>
            <!-- to do loop number  -->
            <td>{{ $admin->name }}</td>
            <td>{{ $admin->username }}</td>
            <td>{{$admin->email }}</td>
            <td>{{ $admin->email_verified ? $admin->email_verified : 'non verify' }}</td>
        </tr>
        @empty

        <h2>
            non admin to display
        </h2>
        @endforelse

    </tbody>
</table>


@endsection