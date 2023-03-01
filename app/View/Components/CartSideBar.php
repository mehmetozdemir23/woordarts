<?php

namespace App\View\Components;

use App\Models\Product;
use Illuminate\View\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;

class CartSideBar extends Component
{

    public $cart_items;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->cart_items = Cart::getItems();
    }



    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.cart-side-bar');
    }
}
