@if (isset($label))
<label for="{{$id ?? $name }}">{{$label}}</label>
@endif
<input type="{{$type ?? 'text' }}" class="form-control input @error($name) is-invalid @enderror" name="{{$name}}"
    placeholder="{{$placeholder}}" id="{{$id ?? $name}}" value="{{old($name,$value ?? null )}}">
@error($name)
<p class="invalid-feedback">{{$message}}</p>
@enderror()