    @extends('layout.admin')
    @section('title')
    {{$title}}

    <a href="{{ route('catagories.create')}}"> Create</a>
    @endsection
    @section('breadcrumb')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('catagories.index')}}"> Categories </a></li>
    </ol>
    @endsection
    @section('content')
    <x-alert />
    <table class="table">
        <thead>
            <tr>
                <th>loop</th>
                <th>ID</th>
                <th>Name</th>
                <th>Slug</th>
                <th>Paretn ID </th>
                <th>Paretn count</th>
                <th>Status </th>
                <th>Edit</th>
                <th>Delete</th>
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
                <td>{{ @$catagory->parent->name}}</td>
                <td>{{ $catagory->count}}</td>
                <td>{{ $catagory->status }}</td>
                <td> <a href="{{route('catagories.edit',$catagory->id)}}" class="btn btn-sm btn-dark"> Edit</a> </td>
                <td>
                    <form action="{{route('catagories.destroy',$catagory->id)}}" method="post">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-sm btn-danger"> Delete</button>
                    </form>
                </td>
                <td>{{ $catagory->created_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>


    @endsection
