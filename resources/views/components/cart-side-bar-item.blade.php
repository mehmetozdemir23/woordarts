<li>
    <a href="{{ route('products.show', ['product' => $cart_item['product_id']]) }}" class="image"><img
            src="{{ $cart_item['product_item_thumbnail'] }}" alt="Cart product Image"></a>
    <div class="content">
        <a href="{{ route('products.show', ['product' => $cart_item['product_id']]) }}"
            class="title">{{ $cart_item['product_name'] }}</a>
        <span class="quantity-price">
            {{ $cart_item['quantity'] }} x
            <span class="amount">${{ $cart_item['product_item_price'] }}</span></span>

        <form action="{{ route('cart.remove') }}" method="post">
            @csrf
            <input type="hidden" name="product_item_id" value="{{ $cart_item['product_item_id'] }}">
            <button class="remove fa fa-times"></button>
        </form>
    </div>
</li>
