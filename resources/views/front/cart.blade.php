@php
$page = __('Cart');
@endphp

<x-store-front-layout :title="__('Cart')">
    <x-breadcrumb :page="$page" />
    <div class="cart">
        <div class="container">
            <div class="modal-dialog modal-lg modal-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header border-bottom-0">
                        <h5 class="modal-title" id="exampleModalLabel">
                            Your Shopping Cart
                        </h5>

                    </div>
                    <div class="modal-body">
                        <table class="table table-image">
                            <thead>
                                <tr>
                                    <th scope="col"></th>
                                    <th scope="col">Product</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Qty</th>
                                    <th scope="col">Total</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($cart as $item )
                                <tr>
                                    <td class="w-25">
                                        <img src="{{$item->product->image_url}}" width="90px" class="img-fluid img-thumbnail" alt="Sheep">
                                    </td>
                                    <td>{{$item->product->name}}</td>
                                    <td>{{$item->product->price}}</td>
                                    <td class="qty">
                                        <input type="number" class="form-control qty-input" name="qty" id="qty_{{$item->id}}" value="{{$item->quantity}}" min="1">
                                    </td>
                                    <td> $ {{$item->product->price * $item->quantity}} </td>
                                    <td>
                                        <form action="{{route('cart.destroy',$item->id)}}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-sm btn-danger"> {{__('Delete')}}</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>

                        </table>
                        <div class="d-flex justify-content-end">
                            <h4>Total: <span class="price text-success">{{$total}}$</span></h4>
                        </div>
                    </div>
                    <div class="modal-footer border-top-0 d-flex justify-content-between">
                        <button type="button" class="btn btn-success"><a class="ps-btn" href="{{route('checkout')}}">Checkout <i class="fa fa-chevron-right"></i>

                            </a></button>
                    </div>
                </div>
            </div>
        </div>












    </div>

</x-store-front-layout>