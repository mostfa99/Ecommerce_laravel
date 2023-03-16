@extends('layout.admin')
@section('title')

<div class="d-flex justify-content-between">
    <h2>{{__('Products List')}}</h2>
    <div class="">
        <a class="btn btn-sm btn-outline-primary" href="{{route('products.create')}}">
            <i class="nav-icon fas fa-edit"></i>{{__('Create')}}</a>
        <a class="btn btn-sm btn-danger" href="{{route('products.trash')}}">{{__('Trash')}}</a>
        <a class="btn btn-sm btn-dark" href="{{route('products.export', request()->query())}}">{{__('Export')}}</a>
        <a class="btn btn-sm btn-success" href="{{route('products.import', request()->query())}}">{{__('Import')}}</a>
    </div>
</div>

@endsection
@section('breadcrumb')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="#">{{__('Home')}}</a></li>
    <li class="breadcrumb-item active"><a href="{{ route('products.index')}}">{{__('Products')}}</a></li>
</ol>
@endsection
@section('content')
<div class="row">
    <div class="col">
        <form action="{{URL::current()}}" method="get" class="d-flex justify-content-between align-items-center mb-4">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <h4 for="name">{{__('Filter')}}</h4>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" name="name" class="form-control" placeholder="{{__('Name')}}" value="{{request('name')}}">
                        <select name="status" class="form-control">
                            <option value="">{{__('All')}}</option>
                            <option value="active" @selected(request('status'))>Active</option>
                            <option value="draft" @selected(request('draft'))>Draft</option>
                        </select>
                        <button class="btn btn-dark ml-3">
                            {{__('Filter')}}
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<x-message type="info" :count="1+1">
    <x-slot name="title">
        Info
    </x-slot>
    Welcome in Larvel
</x-message>

<table class=" table">
    <thead>
        <tr>

            <th></th>
            <th>{{__('Product names')}}</th>
            <th>{{__('Category')}} </th>
            <th> {{__('Price')}}</th>
            <th>{{__('Qty')}}</th>
            <th>{{__('Status')}}</th>
            <th>{{__('Create At')}}</th>
            <th></th>
            <th></th>

        </tr>
    </thead>
    <tbody>

        @forelse($products as $product)
        <tr>
            <!-- to do loop number  -->

            <td><img src="{{ $product->image_url }}" width="60" alt=""></td>
            <td>{{ $product->name }}</td>
            <td>{{$product->category->name}}/{{$product->category->parent->name}}</td>
            <td>{{ $product->formatted_price}}</td>
            <td>{{ $product->quantity }}</td>
            <td>{{ $product->status }}</td>
            <td>{{ $product->created_at }}</td>
            <td>
                <a href="{{route('products.edit',$product->id)}}" class="btn btn-sm btn-dark">
                    {{__('Edit')}}
                </a>
            </td>
            <td>
                <form action="{{route('products.destroy',$product->id)}}" method="post">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-sm btn-danger">{{__('Delete')}}</button>
                </form>
            </td>

        </tr>
        @empty
        <tr>
            <td colspan="7">{{__('There are no products to display')}}</td>
        </tr>
        @endforelse
    </tbody>
</table>

<!-- for number of pages  after paginte in controller to display it  -->
{{ $products->withQueryString()->links() }}

@endsection