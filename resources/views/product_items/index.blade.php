<x-layouts.home>
    <!-- Product Area Start -->
    <div class="product-area pt-100px">
        <div class="container">
            <!-- Section Title & Tab Start -->
            <div class="row">
                <!-- Section Title Start -->
                <div class="col-12">
                    <div class="section-title text-center mb-60px">
                        <h2 class="title">Best Products</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod incididunt ut labore
                            et dolore magna aliqua. </p>
                    </div>
                    <!-- Tab Start -->
                    <div class="tab-slider nav-center nav-center-2">
                        <ul class="product-tab-nav nav justify-content-evenly align-items-center">
                            @foreach ($categories as $category)
                                <li class="nav-item"><a class="nav-link"
                                        href="/category/{{ $category->id }}"><span>{{ $category->category_name }}</span></a>
                                </li>
                            @endforeach
                            {{-- <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab"
                                    href="#tab-wooden-2"><span>Wooden</span></a>
                            </li>

                            <li class="nav-item"><a class="nav-link" data-bs-toggle="tab"
                                    href="#tab-pottery-2"><span>Pottery</span></a>
                            </li>

                            <li class="nav-item"><a class="nav-link" data-bs-toggle="tab"
                                    href="#tab-paintings-2"><span>Paintings</span></a>
                            </li>
                            <li class="nav-item"><a class="nav-link" data-bs-toggle="tab"
                                    href="#tab-jewelry-2"><span>Jewelry</span></a>
                            </li> --}}
                        </ul>
                    </div>
                    <!-- Tab End -->
                </div>
                <!-- Section Title End -->

            </div>
            <!-- Section Title & Tab End -->

            <div class="row">
                <div class="col">
                    <div class="tab-content mt-60px">
                        <!-- 1st tab start -->
                        <div class="tab-pane fade show active" id="tab-fabric-2">
                            <div class="row">
                                @foreach ($products as $product)
                                    <div class="col-lg-4 col-xl-3 col-md-6 col-sm-6 col-xs-6 mb-30px">
                                        <!-- Single Prodect -->
                                        <div class="product">
                                            <div class="thumb">
                                                <a href="{{route('product_items.show',['id'=>$item->id])}}" class="image">
                                                    <img src="{{ $product->images->first()->product_image_path }}"
                                                        alt="Product" />
                                                    <img class="hover-image"
                                                        src="{{ $product->images->first()->product_image_path }}"
                                                        alt="Product" />
                                                </a>
                                                <span class="badges">
                                                    <span class="sale">-10%</span>
                                                    <span class="new">New</span>
                                                </span>
                                                <div class="actions">
                                                    <a href="wishlist.html" class="action wishlist" title="Wishlist"><i
                                                            class="pe-7s-like"></i></a>
                                                    <a href="#" class="action quickview"
                                                        data-link-action="quickview" title="Quick view"
                                                        data-bs-toggle="modal" data-bs-target="#exampleModal"><i
                                                            class="pe-7s-look"></i></a>
                                                    <a href="compare.html" class="action compare" title="Compare"><i
                                                            class="pe-7s-refresh-2"></i></a>
                                                </div>
                                            </div>
                                            <div class="content">
                                                <span class="ratings">
                                                    <span class="rating-wrap">
                                                        <span class="star" style="width: 100%"></span>
                                                    </span>
                                                    <span class="rating-num">( 5 Review )</span>
                                                </span>
                                                <h5 class="title"><a href="single-product.html">Handmade Ceramic
                                                        Pottery
                                                    </a>
                                                </h5>
                                                <span class="price">
                                                    <span class="new">${{$product->item->product_item_price}}</span>
                                                    <span class="old">$45.50</span>
                                                </span>
                                            </div>
                                            <button title="Add To Cart" class=" add-to-cart">Add
                                                To Cart</button>
                                        </div>
                                        <!-- Single Prodect -->
                                    </div>
                                @endforeach



                            </div>
                        </div>
                        <!-- 1st tab end -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Product Area End -->
</x-layouts.home>
