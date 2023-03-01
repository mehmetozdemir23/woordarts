<?php

namespace App\View\Components;

use App\Models\Product;
use Illuminate\View\Component;

class CartSideBarItem extends Component
{
    public $cart_item;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($cartItem)
    {
        $this->cart_item = $cartItem;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.cart-side-bar-item');
    }
}
