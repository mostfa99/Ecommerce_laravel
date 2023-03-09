<x-store-front-layout :title="__('My Account')">
    <x-breadcrumb :page="'My Account'" />

    <div class="account">
        <div class="row">
            <div class="col-md-3">
                <div class="account-menu">
                    <ul>
                        <li><a href="{{ route('account') }}"><i class="fa fa-dashboard"></i> {{ __('Dashboard') }}</a></li>
                        <li><a href="#"><i class="fa fa-edit"></i> {{ __('Edit Profile') }}</a></li>
                        <li><a href="#"><i class="fa fa-key"></i> {{ __('Change Password') }}</a></li>
                        <li><a href="#"><i class="fa fa-sign-out"></i> {{ __('Logout') }}</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-9">
                <div class="account-content">
                    <h3>{{ __('Dashboard') }}</h3>
                    <p>{{ __('Welcome to your account dashboard.') }}</p>
                </div>
            </div>
        </div>
    </div>
</x-store-front-layout>