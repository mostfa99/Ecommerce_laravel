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
    <x-form-input name="name" label="Product Name" :value="$product->name" />
</div>

<!-- category name -->
<div class="form-group">
    <x-form-select name="category_id" label="Category" :options="$categories" :selected="$product->category_id" />
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
    <x-form-input type="number" name="sku" label="SKU" :value="$product->sku" />
</div>

<!-- Price -->
<div class="form-group">
    <x-form-input type="number" name="price" label="Price" :value="$product->price" />
</div>

<!-- Sale Price -->
<div class="form-group">
    <x-form-input type="number" name="sale_price" label="Sale Price" :value="$product->sale_price" />
</div>

<!-- Quantity -->
<div class="form-group">
    <x-form-input type="number" name="quantity" label="Quantity" :value="$product->quantity" />
</div>

<!-- Weight -->
<div class="form-group">
    <x-form-input type="number" name="weight" label="Weight" :value="$product->weight" />
</div>

<!-- Width -->
<div class="form-group">
    <x-form-input type="number" name="width" label="Width" :value="$product->width" />
</div>

<!-- Hight -->
<div class="form-group">
    <x-form-input type="number" name="hight" label="Hight" :value="$product->hight" />
</div>
<!-- Length -->
<div class="form-group">
    <x-form-input type="number" name="length" label="Length" :value="$product->length" />
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