<x-store-front-layout :title="$category->name">
    <x-breadcrumb :page="$category->name" />

    <div class="category">
        <h3>{{ $category->name }}</h3>

        <div class="row">
            @foreach($products as $product)
            <div class="col-md-4">
                <div class="product-box">
                    <img src="{{ asset($product->image_url) }}" alt="{{ $product->name }}" width="200" height="150">
                    <h4>{{ $product->name }}</h4>
                    <p>{{ $product->description }}</p>
                    <a href="{{ route('products.details', $product->slug) }}" class="btn">{{ __('View Details') }}</a>
                </div>
            </div>
            @endforeach
        </div>

        <div class="pagination">
            {{ $products->links() }}
        </div>
    </div>
</x-store-front-layout>