@extends('layout.admin')

@section('content')
<h2>{{__('User Profile')}}</h2>
@if (session('status') == 'profile-information-updated')
<div class="alert alert-success">
    {{__('your profile updated ')}}
</div>
@endif
<form action="{{route('user-profile-information.update')}}" method="post">
    @csrf
    @method('put')

    <div class="form-group">
        <label for="">{{__('Name')}}</label>
        <input type="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{old('name',$user->name)}}">
        @error('name')
        <p class="invalid-feedback">{{$message}}</p>
        @enderror()
    </div>
    <div class="form-group">
        <label for=""> {{__('Email')}}</label>
        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{old('email',$user->email)}}">
        @error('email')
        <p class="invalid-feedback">{{$message}}</p>
        @enderror()
    </div>

    <!-- Button -->
    <div class="form-group">
        <button type="submit" class="btn btn-primary">{{__('Update')}}</button>
    </div>
</form>

@endsection