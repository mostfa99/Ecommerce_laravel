@extends('layout.admin')
@section('title')
{{$title}} <a href="{{ route('products.create')}}"> Create</a>
@endsection
@section('breadcrumb')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item active"><a href="{{ route('products.index')}}"> Products</a></li>
</ol>
@endsection
@section('content')
@if(Session::has('success'))
<div class="alert alert-success ">
    {{Session::get('success')}}
</div>
@endif

<table class="table">
    <thead>
        <tr>

            <th>Name</th>
            <th>Category </th>
            <th>price </th>
            <th>Qty. </th>
            <th>Status </th>
            <th>Create At</th>
        </tr>
    </thead>
    <tbody>

        @foreach($products as $product)
        <tr>
            <!-- to do loop number  -->
            <td>{{ $product->name }}</td>
            <td>{{ $product->category_name }}</td>
            <td>{{ $product->price }}</td>
            <td>{{ $product->quantity }}</td>
            <td>{{ $product->status }}</td>
            <td>{{ $product->created_at }}</td>
            <td>
                <a href="{{route('products.edit',$product->id)}}" class="btn btn-sm btn-dark">
                    Edit
                </a>
            </td>
            <td>
                <form action="{{route('products.destroy',$product->id)}}" method="post">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-sm btn-danger"> Delete</button>
                </form>
            </td>

        </tr>
        @endforeach
    </tbody>
</table>


@endsection
