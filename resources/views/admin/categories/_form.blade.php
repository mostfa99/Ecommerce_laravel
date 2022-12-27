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
    <label for=""> Category Name</label>
    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
        value="{{old('name',$category->name)}}">
    @error('name')
    <p class="invalid-feedback">{{$message }}</p>
    @enderror()
</div>

<!-- Parent id -->
<div class="form-group">
    <label for=""> Parent</label>
    <select name="parent_id" id="parent_id" class="form-control @error('parent_id') is-invalid @enderror">
        <option value="">No Parent</option>
        @foreach ($parents as $parent )
        <option value="{{$parent->id}}" @if ($parent->id == old('parent_id',$category->parent_id)) selected @endif>
            {{$parent->name}} </option>
        @endforeach
    </select>
    @error('parent_id')
    <p class="invalid-feedback">{{$message }}</p>
    @enderror()
</div>

<!-- Descraption -->
<div class="form-group">
    <label for=""> Descraption</label>
    <textarea class="form-control @error('descraption') is-invalid @enderror"
        name="descraption"> {{old('descraption',$category->descraption)}}</textarea>
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

<!-- Status -->
<div class="form-group">
    <label for="status">Status </label>
    <div>
        <div class="form-check ">
            <input class="form-check-input" type="radio" name="status" value="active" id="status-active"
                @if(old('status',$category->status)=='active ' ) checked @endif>
            <label class="form-check-label" for="status-active">
                Active
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="status" value="draft" id="status-draft"
                @if(old('status',$category->status)=='draft' ) checked @endif>
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