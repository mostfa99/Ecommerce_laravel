@extends('layout.admin')
@section('title')
{{$title}}

<div class="">
    <a class="btn btn-sm btn-outline-dark" href="{{route('orders.trash')}}">{{__('Trash')}}</a>
</div>
@endsection
@section('breadcrumb')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard')}}">{{__('Home')}}</a></li>
    <li class="breadcrumb-item active"><a href="{{ route('orders.index')}}">{{__('Categories')}}</a></li>
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
                        <input type="number" name="order_number" class="form-control" placeholder="{{__('Order Number')}}" value="{{request('order_number')}}">
                        <select name="status" class="form-control">
                            <option value="">{{__('All')}}</option>
                            <option value="active" @selected(request('status'))>pending</option>
                            <option value="draft" @selected(request('cancelled'))>cancelled</option>
                            <option value="draft" @selected(request('processing'))>processing</option>
                            <option value="draft" @selected(request('shipping'))>shipping</option>
                            <option value="draft" @selected(request('completed'))>completed</option>

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

<table class="table">
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
            <td> <a href="" class="btn btn-sm btn-dark">{{__('Edit')}}</a>
            </td>
            <td>
                <form action="{{route('orders.destroy',$order->id)}}" method="post">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-sm btn-danger"> {{__('Delete')}}</button>
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
<!-- for number of pages  after paginte in controller to display it  -->
<!-- http://localhost:8000/admin/products?page=2&cat_id=1 -->
{{ $orders->withQueryString()->links() }}
@endsection