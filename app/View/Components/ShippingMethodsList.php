<?php

namespace App\View\Components;

use App\Models\ShippingMethod;
use Illuminate\View\Component;

class ShippingMethodsList extends Component
{

    public $shipping_methods;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->shipping_methods = ShippingMethod::orderBy('shipping_method_price','asc')->get();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.shipping-methods-list');
    }
}
