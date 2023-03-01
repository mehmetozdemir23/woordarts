<!-- OffCanvas Cart Start -->
<div id="offcanvas-cart" class="offcanvas offcanvas-cart pb-30px">
    <div class="inner">
        <div class="head">
            <span class="title">Cart</span>
            <button class="offcanvas-close">×</button>
        </div>
        <div class="body customScroll">
            <ul class="minicart-product-list">
                @forelse ($cart_items as $cart_item)
                    <x-cart-side-bar-item :cart-item="$cart_item">
                        </x-cart-item>
                    @empty
                        <li>No item in your cart</li>
                @endforelse
            </ul>
        </div>
        <div class="foot mt-auto">
            <div class="buttons">
                <a href="{{ route('cart.index') }}" class="btn btn-dark btn-hover-primary d-flex align-items-center gap-2">
                    <img src="/assets/images/icons/shopping-cart.svg" alt="" style="width:20px;">
                    view cart ({{count($cart_items)}})</a>
            </div>
        </div>
    </div>
</div>
<!-- OffCanvas Cart End -->
