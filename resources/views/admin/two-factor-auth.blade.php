@extends('layout.admin')

@section('content')
<h2>Two factor Authantication </h2>

<form action="{{route('two-factor.enable') }}" method="post">
    @csrf

    @if (session('status') == 'two-factor-authentication-enabled')
    <div class="mb-4 font-medium text-sm">
        Please finish configuring two factor authentication below.
    </div>
    @endif

    <div class="button">

        @if (!$user->two_factor_secret)
        <button type="success" class="btn btn-success">{{__('Enable')}}</button>
        @else
        <div class="p4">

            {!!$user->twoFactorQrCodeSvg() !!}
        </div>
        <hr>

        <h3>
            Recovery code
        </h3>
        <ul class="mb-3">
            @foreach ($user->recoveryCodes() as $code)
            <li> {{$code }}</li>
            @endforeach
        </ul>
        @method('delete')
        <button type="success" class="btn btn-success">{{__('Disable')}}</button>
        @endif
    </div>

</form>
@endsection