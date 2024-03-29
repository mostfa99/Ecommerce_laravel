<x-store-front-layout :title="config('app.name')">

    <!-- SECTION -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <!-- shop -->
                @foreach ($categories as $category)
                <div class="col-md-4 col-xs-6">
                    <div class="shop">
                        <!-- image categories  -->
                        <div class="shop-img">
                            <!-- <img src="{{asset('assets/front/./img/shop02.png')}}" alt=""> -->
                            <img src="{{$category->image_url}}" alt="Category Image">
                        </div>
                        <!-- text and links  -->
                        <div class="shop-body">
                            <h3>{{$category->name}}<br>Collection</h3>
                            <a href="{{route('front.catagories.show', $category->id)}}" class="cta-btn">Shop now <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>
                @endforeach
                <!-- /shop -->
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /SECTION -->

    <!-- SECTION -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">

                <!-- section title -->
                <div class="col-md-12">
                    <div class="section-title">
                        <h3 class="title">New Products</h3>
                        <div class="section-nav">
                            <ul class="section-tab-nav tab-nav">
                                <li class="active"><a data-toggle="*" href="#tab1">All</a></li>
                                @foreach ($categories->take(4) as $category)
                                <li><a data-toggle=".{{$category->slug}}" href="#tab1" class="category-link">
                                        {{ $category->name }}
                                        <sup>{{$category->count}}</sup>
                                    </a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /section title -->

                <!-- Products tab & slick -->
                <div class="col-md-12">
                    <div class="row">
                        <div class="products-tabs">
                            <!-- tab -->
                            <div id="tab1" class="tab-pane active">
                                <div class="products-slick" data-nav="#slick-nav-1">
                                    @foreach ($products as $product )
                                    <x-product-item :product="$product" />
                                    @endforeach

                                </div>
                                <div id="slick-nav-1" class="products-slick-nav"></div>
                            </div>
                            <!-- /tab -->
                        </div>
                    </div>
                </div>
                <!-- Products tab & slick -->
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /SECTION -->

    <!-- HOT DEAL SECTION -->
    <div id="hot-deal" class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-md-12">
                    <div class="hot-deal">
                        <ul class="hot-deal-countdown">
                            <li>
                                <div>
                                    <h3>02</h3>
                                    <span>Days</span>
                                </div>
                            </li>
                            <li>
                                <div>
                                    <h3>10</h3>
                                    <span>Hours</span>
                                </div>
                            </li>
                            <li>
                                <div>
                                    <h3>34</h3>
                                    <span>Mins</span>
                                </div>
                            </li>
                            <li>
                                <div>
                                    <h3>60</h3>
                                    <span>Secs</span>
                                </div>
                            </li>
                        </ul>
                        <h2 class="text-uppercase">hot deal this week</h2>
                        <p>New Collection Up to 50% OFF</p>
                        <a class="primary-btn cta-btn" href="#">Shop now</a>
                    </div>
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /HOT DEAL SECTION -->

    <!-- SECTION -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">

                <!-- section title -->
                <div class="col-md-12">
                    <div class="section-title">
                        <h3 class="title">Top selling</h3>
                        <div class="section-nav">
                            <ul class="section-tab-nav tab-nav">
                                <li class="active"><a data-toggle="tab" href="#tab2">Laptops</a></li>
                                <li><a data-toggle="tab" href=".laptops">Smartphones</a></li>
                                <li><a data-toggle="tab" href="#tab2">Cameras</a></li>
                                <li><a data-toggle="tab" href="#tab2">Accessories</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /section title -->

                <!-- Products tab & slick -->
                <div class="col-md-12">
                    <div class="row">
                        <div class="products-tabs">
                            <!-- tab -->
                            <div id="tab2" class="tab-pane fade in active">
                                <div class="products-slick" data-nav="#slick-nav-2">
                                    <!-- product -->
                                    @foreach ($products as $product )
                                    <x-product-item :product="$product" />
                                    @endforeach
                                    <!-- /product -->
                                </div>
                                <div id="slick-nav-2" class="products-slick-nav"></div>
                            </div>
                            <!-- /tab -->
                        </div>
                    </div>
                </div>
                <!-- /Products tab & slick -->
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /SECTION -->

    <!-- SECTION -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-md-4 col-xs-6">
                    <div class="section-title">
                        <h4 class="title">Top selling</h4>
                        <div class="section-nav">
                            <div id="slick-nav-3" class="products-slick-nav"></div>
                        </div>
                    </div>

                    <div class="products-widget-slick" data-nav="#slick-nav-3">
                        <div>
                            <!-- product widget -->
                            @foreach ($products->take(3) as $product )
                            <!-- product widget -->
                            <div class="product-widget">
                                <div class="product-img">
                                    <img src="{{$product->image_url}}" alt="Product Image">
                                </div>
                                <div class="product-body">
                                    <p class="product-category">{{$product->category_name}}</p>
                                    <h3 class="product-name"><a href="{{$product->premalink}}">{{$product->name}}</a></h3>
                                    <h4 class="product-price">{{$product->sale_price}}$ <del class="product-old-price">{{$product->price}}$</del>
                                </div>
                            </div>
                            <!-- /product widget -->
                            @endforeach
                        </div>
                        <div>
                            <!-- product widget -->
                            @foreach ($products->take(3) as $product )
                            <!-- product widget -->
                            <div class="product-widget">
                                <div class="product-img">
                                    <img src="{{$product->image_url}}" alt="Product Image">
                                </div>
                                <div class="product-body">
                                    <p class="product-category">{{$product->category_name}}</p>
                                    <h3 class="product-name"><a href="{{$product->premalink}}">{{$product->name}}</a></h3>
                                    <h4 class="product-price">{{$product->sale_price}}$ <del class="product-old-price">{{$product->price}}$</del>
                                </div>
                            </div>
                            <!-- /product widget -->
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="col-md-4 col-xs-6">
                    <div class="section-title">
                        <h4 class="title">Top selling</h4>
                        <div class="section-nav">
                            <div id="slick-nav-4" class="products-slick-nav"></div>
                        </div>
                    </div>

                    <div class="products-widget-slick" data-nav="#slick-nav-4">
                        <div>
                            <!-- product widget -->
                            @foreach ($products->take(3) as $product )
                            <!-- product widget -->
                            <div class="product-widget">
                                <div class="product-img">
                                    <img src="{{$product->image_url}}" alt="Product Image">
                                </div>
                                <div class="product-body">
                                    <p class="product-category">{{$product->category_name}}</p>
                                    <h3 class="product-name"><a href="{{$product->premalink}}">{{$product->name}}</a></h3>
                                    <h4 class="product-price">{{$product->sale_price}}$ <del class="product-old-price">{{$product->price}}$</del>
                                </div>
                            </div>
                            <!-- /product widget -->
                            @endforeach
                        </div>
                        <div>
                            <!-- product widget -->
                            @foreach ($products->take(3) as $product )
                            <!-- product widget -->
                            <div class="product-widget">
                                <div class="product-img">
                                    <img src="{{$product->image_url}}" alt="Product Image">
                                </div>
                                <div class="product-body">
                                    <p class="product-category">{{$product->category_name}}</p>
                                    <h3 class="product-name"><a href="{{$product->premalink}}">{{$product->name}}</a></h3>
                                    <h4 class="product-price">{{$product->sale_price}}$ <del class="product-old-price">{{$product->price}}$</del>
                                </div>
                            </div>
                            <!-- /product widget -->
                            @endforeach
                        </div>

                    </div>
                </div>

                <div class="clearfix visible-sm visible-xs"></div>

                <div class="col-md-4 col-xs-6">
                    <div class="section-title">
                        <h4 class="title">Top selling</h4>
                        <div class="section-nav">
                            <div id="slick-nav-5" class="products-slick-nav"></div>
                        </div>
                    </div>
                    <div>
                        <div class="products-widget-slick" data-nav="#slick-nav-5">
                            <div>
                                @foreach ($products->take(3) as $product )
                                <!-- product widget -->
                                <div class="product-widget">
                                    <div class="product-img">
                                        <img src="{{$product->image_url}}" alt="Product Image">
                                    </div>
                                    <div class="product-body">
                                        <p class="product-category">{{$product->category_name}}</p>
                                        <h3 class="product-name"><a href="{{$product->premalink}}">{{$product->name}}</a></h3>
                                        <h4 class="product-price">{{$product->sale_price}}$ <del class="product-old-price">{{$product->price}}$</del>
                                    </div>
                                </div>
                                <!-- /product widget -->
                                @endforeach
                            </div>
                            <div>
                                @foreach ($products->take(3) as $product )
                                <!-- product widget -->
                                <div class="product-widget">
                                    <div class="product-img">
                                        <img src="{{$product->image_url}}" alt="Product Image">
                                    </div>
                                    <div class="product-body">
                                        <p class="product-category">{{$product->category_name}}</p>
                                        <h3 class="product-name"><a href="{{$product->premalink}}">{{$product->name}}</a></h3>
                                        <h4 class="product-price">{{$product->sale_price}}$ <del class="product-old-price">{{$product->price}}$</del>
                                    </div>
                                </div>
                                <!-- /product widget -->
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /SECTION -->
</x-store-front-layout>