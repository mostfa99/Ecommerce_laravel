<div class="dropdown">
    <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
        <i class="fa fa-shopping-cart"></i>
        <span>Your Cart</span>
        <div class="qty">3</div>
    </a>
    <div class="cart-dropdown">
        <div class="cart-list">
            @foreach ($cart->all() as $item )
            <div class="product-widget">
                <div class="product-img">
                    <img src="{{$item->product->image_url}}" alt="">
                </div>
                <div class="product-body">
                    <h3 class="product-name">
                        <a href="{{$item->product->premalink}}">{{$item->product->name}}</a>
                    </h3>
                    <h4 class="product-price">
                        <span class="qty" name="quantity">{{$item->quantity}}x</span>${{$item->product->price}}
                    </h4>
                </div>
                <button class="delete"><i class="fa fa-close"></i></button>
            </div>
            @endforeach

        </div>
        <div class="cart-summary">
            <small>{{$cart->quantity()}}x Item(s) selected</small>
            <h5>SUBTOTAL: ${{$cart->total()}}</h5>
        </div>
        <div class="cart-btns">
            <a href="{{route('cart')}}">View Cart</a>
            <a href="#">Checkout <i class="fa fa-arrow-circle-right"></i></a>

        </div>
    </div>
</div>