<!-- Flash Massage for error that will display wrong submit  -->
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $message)
        <li>
            {{$message}}
        </li>
        @endforeach
    </ul>
</div>
@endif

<!-- Name  -->
<div class="form-group">
    <label for=""> Product Name</label>
    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
        value="{{old('name',$product->name)}}">
    @error('name')
    <p class="invalid-feedback">{{$message}}</p>
    @enderror()
</div>

<!-- category name -->
<div class="form-group">
    <label for=""> Category </label>
    <select name="category_id" id="category_id" class="form-control @error('category_id') is-invalid @enderror">
        <option value="">Select Category</option>
        @foreach ($categories as $category)
        <option value="{{$category->id}}" @if($category->id == old('category_id', $product->category_id)) selected
            @endif>
            {{$category->name}}</option>
        @endforeach
    </select>
    @error('category_id')
    <p class="invalid-feedback">{{$message}}</p>
    @enderror()
</div>

<!-- Descraption -->
<div class="form-group">
    <label for="">Descraption</label>
    <textarea class="form-control @error('descraption') is-invalid @enderror" name="descraption">
    {{old('descraption',$product->descraption)}}
    </textarea>
    @error('descraption')
    <p class="invalid-feedback">{{$message}}</p>
    @enderror()
</div>

<!-- Image -->
<div class="form-group">
    <label for=""> Image</label>
    <input type="file" class="form-control @error('image') is-invalid @enderror" name="image">
    @error('image')
    <p class="invalid-feedback">{{$message}}</p>
    @enderror()
</div>

<!-- SKU -->
<div class="form-group">
    <label for="sku"> SKU</label>
    <input type="text" class="form-control @error('sku') is-invalid @enderror" name="sku"
        value="{{old('sku',$product->sku)}}">
    @error('sku')
    <p class="invalid-feedback">{{$message}}</p>
    @enderror()
</div>

<!-- Price -->
<div class="form-group">
    <label for="price"> Price</label>
    <input type="integer" class="form-control @error('price') is-invalid @enderror" name="price"
        value="{{old('price',$product->price)}}">
    @error('price')
    <p class="invalid-feedback">{{$message}}</p>
    @enderror()
</div>

<!-- Sale Price -->
<div class="form-group">
    <label for="sale_price"> Sale Price</label>
    <input type="integer" class="form-control @error('sale_price') is-invalid @enderror" name="sale_price"
        value="{{old('sale_price',$product->sale_price)}}">
    @error('sale_price')
    <p class="invalid-feedback">{{$message}}</p>
    @enderror()
</div>

<!-- Quantity -->
<div class="form-group">
    <label for="quantity">Quantity</label>
    <input type="integer" class="form-control @error('quantity') is-invalid @enderror" name="quantity"
        value="{{old('quantity',$product->quantity)}}">
    @error('quantity')
    <p class="invalid-feedback">{{$message}}</p>
    @enderror()
</div>

<!-- Weight -->
<div class="form-group">
    <label for="weight">Weight</label>
    <input type="integer" class="form-control @error('weight') is-invalid @enderror" name="weight"
        value="{{old('weight',$product->weight)}}">
    @error('weight')
    <p class="invalid-feedback">{{$message}}</p>
    @enderror()
</div>

<!-- Width -->
<div class="form-group">
    <label for="width">Width</label>
    <input type="integer" class="form-control @error('width') is-invalid @enderror" name="width"
        value="{{old('width',$product->width)}}">
    @error('width')
    <p class="invalid-feedback">{{$message}}</p>
    @enderror()
</div>

<!-- Hight -->
<div class="form-group">
    <label for="hight">hight</label>
    <input type="integer" class="form-control @error('hight') is-invalid @enderror" name="hight"
        value="{{old('hight',$product->hight)}}">
    @error('hight')
    <p class="invalid-feedback">{{$message}}</p>
    @enderror()
</div>
<!-- Length -->
<div class="form-group">
    <label for="length">Length</label>
    <input type="integer" class="form-control @error('length') is-invalid @enderror" name="length"
        value="{{old('length',$product->length)}}">
    @error('length')
    <p class="invalid-feedback">{{$message}}</p>
    @enderror()
</div>


<!-- Status -->
<div class="form-group">
    <label for="status">Status </label>
    <div>
        <div class="form-check ">
            <input class="form-check-input" type="radio" name="status" value="active" id="status-active"
                @if(old('status',$product->status) == 'active' ) checked @endif>
            <label class="form-check-label" for="status-active">
                Active
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="status" value="draft" id="status-draft"
                @if(old('status',$product->status) == 'draft' ) checked @endif>
            <label class="form-check-label" for="status-draft">
                Draft
            </label>
        </div>
    </div>
    @error('status')
    <p class="text-danger">{{ $message }}</p>
    @enderror()
</div>

<!-- Button -->
<div class="form-group">
    <button type="submit" class="btn btn-primary"> {{ $buttun }}</button>
</div>