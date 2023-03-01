<header>
    <div class="header-main sticky-nav ">
        <div class="container position-relative">
            <div class="row">
                <div class="col-auto align-self-center">
                    <div class="header-logo">
                        <a href="index.html"><img src="/assets/images/logo/logo.png" alt="Site Logo" /></a>
                    </div>
                </div>
                <div class="col align-self-center d-none d-lg-block">
                    <div class="main-menu">
                        <ul>
                            <x-layouts.header-nav-item routeName="home" label="Home"></x-layouts.header-nav-item>
                            <x-layouts.header-nav-item routeName="products.index" label="Products"></x-layouts.header-nav-item>
                            {{-- <x-layouts.header-nav-item routeName="categories.index" label="Categories"></x-layouts.header-nav-item> --}}
                        </ul>
                    </div>
                </div>
                <!-- Header Action Start -->
                <div class="col col-lg-auto align-self-center pl-0">
                    <div class="header-actions">
                        <!-- Single Wedge Start -->
                        <a href="#" class="header-action-btn" data-bs-toggle="modal"
                            data-bs-target="#searchActive">
                            <i class="pe-7s-search"></i>
                        </a>
                        <!-- Single Wedge End -->
                        <div class="header-bottom-set dropdown">
                            <button class="dropdown-toggle header-action-btn" data-bs-toggle="dropdown"><i
                                    class="pe-7s-users"></i></button>
                            <ul class="dropdown-menu dropdown-menu-right">
                                @auth
                                    <li><a class="dropdown-item" href="{{ route('account.dashboard') }}">My account</a>
                                    </li>
                                    <li><a class="dropdown-item" href="checkout.html">Checkout</a></li>
                                    <li><a class="dropdown-item" href="{{ route('auth.logout') }}">Sign out</a></li>
                                @else
                                    <li><a class="dropdown-item" href="{{ route('auth.login.create') }}">Sign in</a></li>
                                @endauth
                            </ul>
                        </div>
                        <!-- Single Wedge Start -->
                        <a href="#offcanvas-wishlist" class="header-action-btn offcanvas-toggle">
                            <i class="pe-7s-like"></i>
                        </a>
                        <!-- Single Wedge End -->
                        <a href="#offcanvas-cart"
                            class="header-action-btn header-action-btn-cart offcanvas-toggle pr-0">
                            <i class="pe-7s-shopbag"></i>
                            @php
                                $cart_size =
                                    Auth::user()?->cart->items->count() ??
                                    count(
                                        request()
                                            ->session()
                                            ->get('cart') ?? [],
                                    );
                            @endphp
                            <span class="header-action-num">{{ $cart_size }}</span>
                            <!-- <span class="cart-amount">€30.00</span> -->
                        </a>
                        <a href="#offcanvas-mobile-menu"
                            class="header-action-btn header-action-btn-menu offcanvas-toggle d-lg-none">
                            <i class="pe-7s-menu"></i>
                        </a>
                    </div>
                    <!-- Header Action End -->
                </div>
            </div>
        </div>
    </div>
</header>
