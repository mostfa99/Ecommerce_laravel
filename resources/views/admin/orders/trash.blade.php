@extends('layout.admin')
@section('title')

<div class="d-flex justify-content-between">
    <h2>Trash Products</h2>
</div>

@endsection
@section('breadcrumb')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item active"><a href="{{ route('orders.index')}}"> Trash Orders</a></li>
</ol>
@endsection
@section('content')
<x-alert />
<div class="d-flex mb-4">
    <form action="{{route('orders.restore')}}" method="post" class="mr-3">
        @csrf
        @method('put')
        <button type="submit" class="btn btn-sm btn-warning"> Restore all</button>
    </form>
    <form action="{{route('orders.force-delete')}}" method="post">
        @csrf
        @method('delete')
        <button type="submit" class="btn btn-sm btn-danger"> Empty Trash </button>
    </form>
</div>

<table class=" table">
    <thead>
        <tr>
            <!-- <th>{{__('loop')}}</th> -->
            <th>{{__('ID')}}</th>
            <th>{{__('Order Number')}}</th>
            <!-- <th>{{__('Slug')}}</th> -->
            <th>{{__('Shiping Name')}} </th>
            <th>{{__('Payment Status')}}</th>
            <th>{{__('Status')}}</th>
            <th>{{__('Create At')}}</th>
            <th>{{__('Edit')}}</th>
            <th>{{__('Delete')}}</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($orders as $order)
        <tr>
            <!-- to do loop number  -->
            <!-- <td>{{ $loop->first? 'First' :($loop->last? 'Last' : $loop->iteration) }}</td> -->
            <td>{{$order->id}}</td>
            <td>{{ $order->number }}</td>
            <!-- <td>{{ $order->slug }}</td> -->
            <td>{{ @$order->shipping_name}}</td>
            <td>{{ $order->payment_status}}</td>
            <td>{{ $order->status }}</td>
            <td>{{ $order->created_at }}</td>
            <td>
                <form action="{{ route('orders.restore', ['id' => $order->id]) }}" method="post">
                    @csrf
                    @method('put')
                    <button type="submit" class="btn btn-sm btn-warning"> Restore</button>
                </form>
            </td>
            <td>
                <form action="{{ route('orders.force-delete', ['id' => $order->id]) }}" method="post">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-sm btn-danger"> Delete forever</button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="7">There are no orders to display</td>
        </tr>
        @endforelse
    </tbody>
</table>

{{ $orders->links() }}

@endsection