<!-- product -->
<div class="product">
    <div class="product-img">
        <img src="{{$product->image_url}}" alt="Product Image" width="250" height="250">
        <div class="product-label">
            <span class="sale">-30%</span>
            <span class="new">NEW</span>
        </div>
    </div>
    <div class="product-body">
        <p class="product-category">{{$product->category_name}}</p>
        <h3 class="product-name"><a class="ps-shoe__overlay" href="{{$product->premalink}}">{{$product->name}}</a></h3>
        <h4 class="product-price">{{$product->sale_price}}$ <del class="product-old-price">{{$product->price}}$</del>
        </h4>
        <div class="product-rating">
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
        </div>
        <div class="product-btns">
            <form action="{{ route('wishlist.add', $product->id) }}" method="POST">
                @csrf
                <button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">add to
                        wishlist</span></button>
            </form>

            <button class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">add to
                    compare</span></button>
            <button class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">quick view</span></button>
        </div>
    </div>

    <div class="add-to-cart">
        <button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to
            cart</button>
    </div>
</div>

<!-- /product -->