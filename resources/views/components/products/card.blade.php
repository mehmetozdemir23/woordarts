@props(['product'])
<div class="col-md-4 col-sm-6 col-xs-6 mb-30px" data-aos="fade-up" data-aos-delay="200">
    <!-- Single Prodect -->
    <div class="product">
        <div class="thumb">
            <a href="{{route('products.show',['product'=>$product])}}" class="image">
                <img src="{{$product->item->thumbnail()}}" alt="Product" />
            </a>
            {{-- <span class="badges">
                <span class="new">New</span>
            </span> --}}
            <div class="actions">
                <a href="wishlist.html" class="action wishlist" title="Wishlist"><i class="pe-7s-like"></i></a>
            </div>
        </div>
        <div class="content">
            {{-- <span class="ratings">
                <span class="rating-wrap">
                    <span class="star" style="width: 100%"></span>
                </span>
                <span class="rating-num d-none">( 5 Review )</span>
            </span> --}}
            <h5 class="title"><a href="{{route('products.show',['product'=>$product])}}">
                {{$product->product_name}}
                </a>
            </h5>
            <span class="price">
                <span class="new">${{$product->item->product_item_price}}</span>
            </span>
        </div>
        <form action="{{route('cart.add')}}" method="post">
            @csrf
            <input type="hidden" name="product_item_id" value="{{$product->item->id}}">
            <input type="hidden" name="quantity_to_add" value="1">
            <button title="Add To Cart" class=" add-to-cart">Add
                To Cart</button>
        </form>
    </div>
</div>
