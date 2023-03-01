<x-layouts.app>
    <!-- checkout area start -->
    <div class="checkout-area pt-100px pb-100px">
        <div class="container">
            <form action="{{ route('payment.auth') }}" method="post">
                @csrf
                <input type="hidden" name="auth_user_id" value="{{ $user->id }}">
                <input type="hidden" name="auth_user_order_id" value="{{ $order->id }}">
                <div class="row">
                    <div class="col-lg-7">
                        <div class="billing-info-wrap">
                            <h3>Shipping Details</h3>
                            <div class="row">
                                @if ($user->shippingAddress())
                                    @php
                                        $shipping_address = $user->shippingAddress();
                                    @endphp
                                    <div class="custom-check d-flex align-items-start">
                                        <input class="custom-check-input" type="radio"
                                            id="shipping_address_{{ $shipping_address->id }}" name="shipping_address_id"
                                            value="{{ $shipping_address->id }}"
                                            {{ $shipping_address->id == $user->shippingAddress()?->id ? 'checked' : '' }}>
                                        <label class="custom-check-label p-0 mb-4"
                                            for="shipping_address_{{ $shipping_address->id }}">
                                            <div>
                                                {{ $shipping_address->address_line_1 }}<br>
                                                @if ($shipping_address->address_line_2)
                                                    {{ $shipping_address->address_line_2 }}<br>
                                                @endif
                                                {{ $shipping_address->address_postal_code }}
                                                {{ $shipping_address->address_city }}<br>
                                                @if ($shipping_address->address_region)
                                                    {{ $shipping_address->address_region }}<br>
                                                @endif
                                                {{ $shipping_address->country->country_name }}
                                            </div>
                                        </label>
                                    </div>
                                @endif
                                @foreach ($user->addresses as $address)
                                    @if ($address->id != $shipping_address?->id)
                                        <div class="custom-check d-flex align-items-start">
                                            <input class="custom-check-input" type="radio"
                                                id="shipping_address_{{ $address->id }}" name="shipping_address_id"
                                                value="{{ $address->id }}">
                                            <label class="custom-check-label p-0 mb-4"
                                                for="shipping_address_{{ $address->id }}">
                                                <div>
                                                    {{ $address->address_line_1 }}<br>
                                                    @if ($address->address_line_2)
                                                        {{ $address->address_line_2 }}<br>
                                                    @endif
                                                    {{ $address->address_postal_code }}
                                                    {{ $address->address_city }}<br>
                                                    @if ($address->address_region)
                                                        {{ $address->address_region }}<br>
                                                    @endif
                                                    {{ $address->country->country_name }}
                                                </div>
                                            </label>
                                        </div>
                                    @endif
                                @endforeach
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
                                            @foreach ($order->orderLines as $order_line)
                                                <li><span
                                                        class="order-middle-left">{{ $order_line->productItem->product->product_name }}
                                                        X {{ $order_line->order_line_quantity }}</span> <span
                                                        class="order-price">${{ $order_line->order_line_price }}
                                                    </span>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div class="your-order-bottom">
                                        <ul>
                                            <li class="your-order-shipping">Shipping</li>
                                            <li>{{ $order->shippingMethod->shipping_method_name }} ( +
                                                ${{ $order->shippingMethod->shipping_method_price }} )</li>
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
