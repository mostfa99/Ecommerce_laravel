<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>
        <x-auth-session-status class="mb-4" :status="session('status')" />
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <h2 class="">2fa Challange </h2>
            <!-- Session Status -->

            <form action="{{route('two-factor.login') }}" method="post">
                @csrf

                @if ($errors->has('code'))
                <div class="alert alert-danger">
                    {{$errors->first('code') }}
                </div>
                @endif
                <div class="form-group input-group">
                    <x-input-label for="text" :value="__(' 2FA Code')" />
                    <x-text-input id="reg-code" class="block mt-1 w-full" type="text" name="code" autofocus />

                </div>

                <div class="form-group input-group">
                    <x-input-label for="text" :value="__(' 2FA Recovry Code')" />
                    <x-text-input id="reg-recovery_code" class="block mt-1 w-full" type="text" name="recovery_code" autofocus />
                </div>
                <div class="flex items-center justify-end mt-4">
                    <x-primary-button type="success" class="ml-3">
                        {{__('Submit')}}
                    </x-primary-button>
                </div>


            </form>
        </div>
    </x-auth-card>
</x-guest-layout>