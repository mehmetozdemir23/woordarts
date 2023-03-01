<x-layouts.app>
    <!-- checkout area start -->

    @if ($errors->any())
        <div class="alert alert-danger">
            Please fill the form correctly.
        </div>
    @endif
    <div class="checkout-area pt-100px pb-100px">
        <div class="container">
            <form action="{{ route('payment.guest') }}" method="post">
                @csrf
                <input type="hidden" name="guest_order_id" value="{{ $guest_order->id }}">
                <div class="row">
                    <div class="col-lg-7">
                        <div class="billing-info-wrap">
                            <h3>Shipping Details</h3>
                            <div class="row">
                                <x-checkout.input name="guest_order[user][firstname]" label="First Name" required
                                    class="col-lg-6 col-md-6">
                                </x-checkout.input>
                                <x-checkout.input name="guest_order[user][lastname]" label="Last Name" required
                                    class="col-lg-6 col-md-6">
                                </x-checkout.input>
                                <div class="col-lg-12">
                                    <div class="billing-select mb-4">
                                        @php
                                            $country_not_selected = $errors->has('guest_order.shipping_address.country');
                                        @endphp
                                        <label>Country *</label>
                                        <select name="guest_order[shipping_address][country]" required
                                            class="{{ $country_not_selected ? 'border border-danger' : '' }}">
                                            <option disabled selected>
                                                @if ($country_not_selected)
                                                    Please choose your country
                                                @else
                                                    {{ old('guest_order.shipping_address.country') ?? 'Select your country' }}
                                                @endif
                                            </option>
                                            <option>Azerbaijan</option>
                                            <option>Bahamas</option>
                                            <option>Bahrain</option>
                                            <option>Bangladesh</option>
                                            <option>Barbados</option>
                                        </select>
                                    </div>
                                </div>
                                <x-checkout.input name="guest_order[shipping_address][address_line_1]"
                                    label="Address Line 1" required class="col-lg-12">
                                </x-checkout.input>
                                <x-checkout.input name="guest_order[shipping_address][address_line_2]"
                                    label="Address Line 2" class="col-lg-12">
                                </x-checkout.input>
                                <x-checkout.input name="guest_order[shipping_address][city]" label="Town / City" required
                                    class="col-lg-12">
                                </x-checkout.input>
                                <x-checkout.input name="guest_order[shipping_address][region]"
                                    label="Region / State / Province" class="col-lg-6 col-md-6">
                                </x-checkout.input>
                                <x-checkout.input name="guest_order[shipping_address][postal_code]"
                                    label="Postcode / ZIP" required class="col-lg-6 col-md-6">
                                </x-checkout.input>
                                <x-checkout.input type="tel" name="guest_order[user][phone]" label="Phone"
                                    class="col-lg-6 col-md-6">
                                </x-checkout.input>
                                <x-checkout.input type="email" name="guest_order[user][email]" label="Email Address"
                                    required class="col-lg-6 col-md-6">
                                </x-checkout.input>
                            </div>
                            <p>*<em>must be filled</em> </p>
                            <div class="checkout-account mb-30px">
                                <input class="checkout-toggle2 w-auto h-auto" type="checkbox" />
                                <label>Create an account?</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5 mt-md-30px mt-lm-30px ">
                        <div class="your-order-area">
                            <h3>Your order</h3>
                            <div class="your-order-wrap gray-bg-4">
                                <div class="your-order-product-info">
                                    <div class="your-order-top">
                                        <ul>
                                            <li>Product</li>
                                            <li>Total</li>
                                        </ul>
                                    </div>
                                    <div class="your-order-middle">
                                        <ul>
                                            @foreach (json_decode($guest_order->guest_order_details, $associative = true) as $item)
                                                <li><span class="order-middle-left">{{ $item['product_name'] }} X
                                                        {{ $item['order_line_quantity'] }}</span> <span
                                                        class="order-price">${{ $item['order_line_price'] }}
                                                    </span></li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div class="your-order-bottom">
                                        <ul>
                                            <li class="your-order-shipping">Shipping</li>
                                            <li>{{ $guest_order->shippingMethod->shipping_method_name }} (
                                                +${{ $guest_order->shippingMethod->shipping_method_price }} )</li>
                                        </ul>
                                    </div>
                                    <div class="your-order-total">
                                        <ul>
                                            <li class="order-total">Total</li>
                                            <li>${{ $total_price }}</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="Place-order mt-25">
                                <button class="btn-hover d-flex justify-content-center align-items-center">
                                    <img src="/assets/images/icons/credit-card.svg"
                                        style="height:30px;margin-right:10px;" alt="credit card icon">
                                    Proceed to payment</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- checkout area end -->
</x-layouts.app>
