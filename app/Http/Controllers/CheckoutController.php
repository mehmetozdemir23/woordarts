<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\GuestOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function showCheckoutFormForGuest(Request $request)
    {
        return view('checkout.guest', [
            'guest_order' => GuestOrder::find(old('guest_order_id')),
            'total_price' => old('total_price')
        ]);
    }

    public function showCheckoutFormForAuth(Request $request)
    {
        return view('checkout.auth', [
            'order' => Order::find(old('order_id')),
            'total_price' => old('total_price'),
            'user'=>Auth::user()
        ]);
        /*
        $request->validate([
            'shipping_method_id' => 'required|exists:shipping_methods,id'
        ]);

        if (Auth::check()) {
            $auth_user = $request->user();
            $auth_user_order = Order::create([
                'user_id' => $auth_user->id,
                'shipping_method_id' => $request->shipping_method_id
            ]);
            foreach (Cart::getItems() as $cart_item) {
                $auth_user_order->orderLines()->create([
                    'order_id' => $auth_user_order->id,
                    'product_item_id' => $cart_item['product_item_id'],
                    'order_line_quantity' => $cart_item['quantity'],
                    'order_line_price' => $cart_item['quantity']
                        * $cart_item['product_item_price']
                ]);
            }

            return view('checkout.auth', [
                'auth_user' => $auth_user,
                'auth_user_addresses' => $auth_user->addresses,
                'auth_user_default_shipping_address' => $auth_user->shippingAddress(),
                'auth_user_order' => $auth_user_order,
                'total_price' => $auth_user_order->orderLines->sum(fn ($order_line) => $order_line->order_line_price)
                    + $auth_user_order->shippingMethod->shipping_method_price,
            ]);
        }*/
    }

    public function submitCheckoutFormForGuest()
    {
    }
}
