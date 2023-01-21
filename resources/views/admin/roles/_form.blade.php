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
    <label for=""> Role Name</label>
    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
        value="{{old('name',$role->name)}}">
    @error('name')
    <p class="invalid-feedback">{{$message}}</p>
    @enderror()
</div>
<div class="form-group">
    @foreach (config('abilities') as $key => $value)
    <div class="form-check">
        <input class="form-check-input" name="abilities[]" type="checkbox" value="{{$key}}" @if(in_array($key ,
            $role->abilities ?? [])) checked @endif>
        <label class="form-check-label">
            {{$value}}
        </label>
    </div>
    @endforeach
</div>

<!-- Button -->
<div class="form-group">
    <button type="submit" class="btn btn-primary"> {{ $buttun }}</button>
</div>