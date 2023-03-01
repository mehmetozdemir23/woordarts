<x-layouts.app>
    @if (session('success') && now()->lt(session('success_expiration')))
        <div class="fixed-top alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error') && now()->lt(session('error_expiration')))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <!-- Cart Area Start -->
    <div class="cart-main-area pt-100px pb-100px">
        <div class="container">
            <h3 class="cart-page-title">Your cart items</h3>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="table-content table-responsive cart-table-content" id="cart-items">
                        <table>
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Product Name</th>
                                    <th>Unit Price</th>
                                    <th>Qty</th>
                                    <th>Subtotal</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($cart_items as $cart_item)
                                    <tr>
                                        <td class="product-thumbnail">
                                            <a href="#"><img class="img-responsive ml-15px"
                                                    src="{{ $cart_item['product_item_thumbnail'] }}"
                                                    alt="" /></a>
                                        </td>
                                        <td class="product-name"><a href="#">{{ $cart_item['product_name'] }}</a>
                                        </td>
                                        <td class="product-price-cart"><span
                                                class="amount">${{ number_format($cart_item['product_item_price'], 2) }}</span>
                                        </td>
                                        <td class="product-quantity">
                                            <form action="{{ route('cart.update') }}" method="post"
                                                id="product_item_{{ $cart_item['product_item_id'] }}">
                                                @csrf
                                                <input type="hidden" name="product_item[id]"
                                                    value="{{ $cart_item['product_item_id'] }}">
                                                <button type="button" class="minus">-</button>
                                                <input type="text" name="product_item[quantity]"
                                                    value="{{ $cart_item['quantity'] }}">
                                                <button type="button" class="plus">+</button>

                                                @push('other-scripts')
                                                    <script>
                                                        document.querySelector('#product_item_' + @json($cart_item['product_item_id'])).querySelector('.minus').addEventListener(
                                                            'click', () => {
                                                                document.querySelector('#product_item_' + @json($cart_item['product_item_id'])).querySelector(
                                                                    "input[name='product_item[quantity]']").value--
                                                                document.querySelector('#product_item_' + @json($cart_item['product_item_id'])).submit()
                                                            })
                                                        document.querySelector('#product_item_' + @json($cart_item['product_item_id'])).querySelector('.plus').addEventListener(
                                                            'click', () => {
                                                                document.querySelector('#product_item_' + @json($cart_item['product_item_id'])).querySelector(
                                                                    "input[name='product_item[quantity]']").value++
                                                                document.querySelector('#product_item_' + @json($cart_item['product_item_id'])).submit()
                                                            })
                                                    </script>
                                                @endpush
                                            </form>

                                        </td>
                                        <td class="product-subtotal">
                                            ${{ number_format($cart_item['product_item_price'] * $cart_item['quantity'], 2) }}
                                        </td>
                                        <td class="product-remove">
                                            <form action="{{ route('cart.remove') }}" method="post">
                                                @csrf
                                                <input type="hidden" name="product_item_id"
                                                    value="{{ $cart_item['product_item_id'] }}">
                                                <button class="fa fa-times"></button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6">No item in your cart</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="cart-shiping-update-wrapper">
                                <div class="cart-shiping-update">
                                    <a href="{{ route('home') }}">Continue Shopping</a>
                                </div>
                                <div class="cart-clear">
                                    <form action="{{ route('cart.clear') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="cart_id" value="{{ Auth::user()?->cart->id }}">
                                        <button>Clear Shopping Cart</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-lg-4 col-md-12 mt-md-30px ml-auto">
                            <div class="grand-totall">
                                <div class="title-wrap">
                                    <h4 class="cart-bottom-title section-bg-gary-cart">Cart Total</h4>
                                </div>
                                <h5>Total products <span>${{ $total_products }}</span></h5>
                                <form action="{{ route('cart.validate') }}" method="post">
                                    @csrf
                                    <div class="total-shipping">
                                        <x-shipping-methods-list></x-shipping-methods-list>
                                    </div>
                                    @if ($total_products > 0)
                                        <button>Proceed to Checkout</button>
                                    @endif
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart Area End -->
</x-layouts.app>
