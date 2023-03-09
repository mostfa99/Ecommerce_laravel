<x-store-front-layout :title="__('Categories')">
    <x-breadcrumb :page="'Categories'" />

    <div class="categories">
        <div class="row">
            <div class="col-md-3">
                <div class="category-menu">
                    <ul>
                        @foreach($categories as $category)
                        <li><a href="#">{{ $category->name }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-md-9">
                <div class="row">
                    @foreach($categories as $category)
                    <div class="col-md-4">
                        <div class="category-box">
                            <h4>{{ $category->name }}</h4>
                            <img src="{{ asset($category->image_url) }}" alt="{{ $category->name }}" width="200" height="150">
                            <a href="{{ route('front.catagories.show', $category) }}" class="btn">{{ __('View Products') }}</a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-store-front-layout>