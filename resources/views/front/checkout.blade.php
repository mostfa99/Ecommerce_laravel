<x-store-front-layout :title="__('Checkout')">
    <!-- SECTION -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <form class="ps-checkout__form" action="{{route('checkout')}}" method="post">
                @csrf
                <!-- row -->
                <div class="row">
                    <div class="col-md-7">
                        <!-- Billing Details -->
                        <div class="billing-details">
                            <div class="section-title">
                                <h3 class="title">Billing address</h3>
                            </div>
                            <div class="form-group">
                                <x-form-input name="billing_name" :label="__('Name')" placeholder="Name" />
                            </div>
                            <div class="form-group">
                                <x-form-input name="billing_email" type="email" :label="__('E-mail')" placeholder="Email" />
                            </div>
                            <div class="form-group">
                                <x-form-input name="billing_address" type="text" :label="__('Address')" placeholder="Address" />
                            </div>
                            <div class="form-group">
                                <x-form-input name="billing_city" type="text" :label="__('City')" placeholder="City" />

                            </div>
                            <div class="form-group">
                                <x-form-select name="billing_country" type="text" :label="__('Country')" :options="$countries" placeholder="Country" />

                            </div>

                            <div class="form-group">
                                <x-form-input name="billing_phone" type="text" :label="__('Phone Number')" placeholder="Phone Number" />
                            </div>
                            <div class="form-group">
                                <div class="input-checkbox">
                                    <input type="checkbox" id="create-account" name="create_account" value="1">
                                    <label for="create-account">
                                        <span></span>
                                        Create Account?
                                    </label>
                                    <div class="caption">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do
                                            eiusmod
                                            tempor
                                            incididunt.</p>
                                        <input class="input" type="password" name="password" placeholder="Enter Your Password">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /Billing Details -->

                        <!-- Shiping Details -->
                        <div class="shiping-details">
                            <div class="section-title">
                                <h3 class="title">Shiping address</h3>
                            </div>
                            <div class="input-checkbox">
                                <input type="checkbox" id="shiping-address">
                                <label for="shiping-address">
                                    <span></span>
                                    Ship to a diffrent address?
                                </label>
                                <div class="caption">
                                    <div class="form-group">
                                        <input class="input" type="text" name="first-name" placeholder="First Name">
                                    </div>
                                    <div class="form-group">
                                        <input class="input" type="text" name="last-name" placeholder="Last Name">
                                    </div>
                                    <div class="form-group">
                                        <input class="input" type="email" name="email" placeholder="Email">
                                    </div>
                                    <div class="form-group">
                                        <input class="input" type="text" name="address" placeholder="Address">
                                    </div>
                                    <div class="form-group">
                                        <input class="input" type="text" name="city" placeholder="City">
                                    </div>
                                    <div class="form-group">
                                        <input class="input" type="text" name="country" placeholder="Country">
                                    </div>
                                    <div class="form-group">
                                        <input class="input" type="text" name="zip-code" placeholder="ZIP Code">
                                    </div>
                                    <div class="form-group">
                                        <input class="input" type="tel" name="tel" placeholder="Telephone">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /Shiping Details -->

                        <!-- Order notes -->
                        <div class="order-notes">
                            <textarea class="input" name="notes" placeholder="Order Notes"></textarea>
                        </div>
                        <!-- /Order notes -->
                    </div>

                    <!-- Order Details -->
                    <div class="col-md-5 order-details">
                        <div class="section-title text-center">
                            <h3 class="title">Your Order</h3>
                        </div>
                        <div class="order-summary">
                            <div class="order-col">
                                <div><strong>PRODUCT</strong></div>
                                <div><strong>TOTAL</strong></div>
                            </div>
                            <div class="order-products">
                                @foreach($cart->all() as $item)
                                <div class="order-col">
                                    <div>{{$item->quantity}}x{{ $item->product->name}}</div>
                                    <div>${{$item->product->price * $item->quantity}}</div>
                                </div>
                                @endforeach

                            </div>
                            <div class="order-col">
                                <div>Shiping</div>
                                <div><strong>FREE</strong></div>
                            </div>
                            <div class="order-col">
                                <div><strong>TOTAL</strong></div>
                                <div><strong class="order-total">${{$cart->total()}}</strong></div>
                            </div>
                        </div>
                        <div class="payment-method">
                            <div class="input-radio">
                                <input type="radio" name="payment" id="payment-1">
                                <label for="payment-1">
                                    <span></span>
                                    Direct Bank Transfer
                                </label>
                                <div class="caption">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                        tempor
                                        incididunt ut labore et dolore magna aliqua.</p>
                                </div>
                            </div>
                            <div class="input-radio">
                                <input type="radio" name="payment" id="payment-2">
                                <label for="payment-2">
                                    <span></span>
                                    Cheque Payment
                                </label>
                                <div class="caption">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                        tempor
                                        incididunt ut labore et dolore magna aliqua.</p>
                                </div>
                            </div>
                            <div class="input-radio">
                                <input type="radio" name="payment" id="payment-3">
                                <label for="payment-3">
                                    <span></span>
                                    Paypal System
                                </label>
                                <div class="caption">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                        tempor
                                        incididunt ut labore et dolore magna aliqua.</p>
                                </div>
                            </div>
                        </div>
                        <div class="input-checkbox">
                            <input type="checkbox" id="terms">
                            <label for="terms">
                                <span></span>
                                I've read and accept the <a href="#">terms & conditions</a>
                            </label>
                        </div>
                        <button class="primary-btn order-submit" type="submit"> Place order </button>
                        <!-- <a href="#" class="primary-btn order-submit">Place order</a> -->
                    </div>
                    <!-- /Order Details -->
                </div>

                <!-- /row -->
            </form>
        </div>
        <!-- /container -->
    </div>
    <!-- /SECTION -->
</x-store-front-layout>