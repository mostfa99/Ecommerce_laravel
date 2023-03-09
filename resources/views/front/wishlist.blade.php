<x-store-front-layout :title="__('Wishlist')">
    <x-breadcrumb :page="$page" />
    <div class="'wishlist'">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    @if(count($wishlist))
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col"></th>
                                    <th scope="col">Product</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($wishlist as $item)
                                <tr>
                                    <td class="w-25">
                                        <img src="{{$item->product->image_url}}" width="90px" class="img-fluid img-thumbnail" alt="Product">
                                    </td>
                                    <td>
                                        <a href="{{route('products.details', $item->product->slug)}}" class="product-link">{{$item->product->name}}</a>
                                    </td>
                                    <td>${{$item->product->price}}</td>
                                    <td>
                                        <form action="{{route('wishlist.destroy', $item->id)}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash-alt"></i> Remove
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <div class="alert alert-warning">
                        Your wishlist is empty.
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

</x-store-front-layout>