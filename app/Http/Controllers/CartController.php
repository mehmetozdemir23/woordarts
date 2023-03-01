<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\CartItem;
use App\Models\GuestOrder;
use App\Models\Order;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index(Request $request)
    {
        $cart_items = collect(Cart::getItems());


        return view('cart.index', [
            'cart_items' => $cart_items,
            'total_products' => $cart_items->sum(function ($cart_item) {
                return $cart_item['quantity'] * $cart_item['product_item_price'];
            })
        ]);
    }


    public function addItem(Request $request)
    {
        $request->validate([
            'product_item_id' => 'required|exists:product_items,id',
            'quantity_to_add' => 'required|numeric'
        ]);
        $product_item_id = $request->product_item_id;
        $quantity = (int) $request->quantity_to_add;
        if (Auth::check()) {
            $user_cart_id = Auth::user()->cart->id;
            $cart_item = CartItem::whereHas('cart', function ($query) use ($user_cart_id) {
                $query->where('id', $user_cart_id);
            })->whereHas('productItem', function ($query) use ($product_item_id) {
                $query->where('id', $product_item_id);
            })->first();
            if ($cart_item) {
                $cart_item->cart_item_quantity++;
                $cart_item->save();
            } else {
                Auth::user()->cart->items()->create([
                    'cart_id' => Auth::user()->cart->id,
                    'product_item_id' => $product_item_id,
                    'cart_item_quantity' => $quantity
                ]);
            }
        } else {
            if ($request->session()->has('cart')) {
                $cart = $request->session()->get('cart');

                if (Arr::exists($cart, $product_item_id))
                    $cart[$product_item_id] += $quantity;

                else $cart[$product_item_id] = $quantity;

                $request->session()->put('cart', $cart);
            } else {
                $cart[$product_item_id] = $quantity;
                $request->session()->put('cart', $cart);
            }
        }

        return back();
    }
    public function updateItem(Request $request)
    {
        $request->validate([
            'product_item' => 'required|exists:product_items,id',
            'product_item.*' => 'required|numeric'
        ]);

        $product_item_id = $request->product_item['id'];
        $product_item_quantity = $request->product_item['quantity'];
        if (Auth::check()) {
            $user_cart_id = Auth::user()->cart->id;
            $cart_item = CartItem::whereHas('cart', function ($query) use ($user_cart_id) {
                $query->where('id', $user_cart_id);
            })->whereHas('productItem', function ($query) use ($product_item_id) {
                $query->where('id', $product_item_id);
            })->first();
            if ($cart_item) {
                $cart_item->cart_item_quantity = $product_item_quantity;
                $cart_item->save();
            }
        } else {
            if ($request->session()->has('cart')) {
                $cart = $request->session()->get('cart');

                if (Arr::exists($cart, $product_item_id)) {
                    if ($product_item_quantity < 1) {
                        unset($cart[$product_item_id]);
                    } else $cart[$product_item_id] = $product_item_quantity;
                    $request->session()->put('cart', $cart);
                }
            }
        }

        return redirect(url()->previous() . '#cart-items');
    }

    public function removeItem(Request $request)
    {
        $request->validate([
            'product_item_id' => 'required|exists:product_items,id'
        ]);
        $product_item_id = $request->product_item_id;

        if (Auth::check()) {
            $user_cart_id = Auth::user()->cart->id;
            $cart_item = CartItem::whereHas('cart', function ($query) use ($user_cart_id) {
                $query->where('id', $user_cart_id);
            })->whereHas('productItem', function ($query) use ($product_item_id) {
                $query->where('id', $product_item_id);
            })->first();
            if ($cart_item) $cart_item->delete();
        } else {
            if ($request->session()->has('cart')) {
                $cart = $request->session()->get('cart');
                if (Arr::exists($cart, $product_item_id)) {
                    unset($cart[$product_item_id]);
                    $request->session()->put('cart', $cart);
                }
            }
        }

        return back();
    }


    public function clear(Request $request)
    {

        if (Auth::check()) {
            $request->validate([
                'cart_id' => 'required|exists:carts,id'
            ]);
            $cart = Cart::find($request->cart_id);
            if ($cart) {
                foreach ($cart->items as $cart_item) {
                    $cart_item->delete();
                }
            }
        } else {
            if ($request->session()->has('cart')) {
                $request->session()->put('cart', []);
            }
        }


        return back();
    }

    public function validateForCheckout(Request $request)
    {
        $request->validate([
            'shipping_method_id' => 'required|exists:shipping_methods,id'
        ]);

        if (Auth::check()) {
            $user = Auth::user();
            $order = $user->orders()->create(
                [
                    'shipping_method_id' => $request->shipping_method_id
                ]
            );

            $user->cart->items()->with('productItem')->each(function ($cart_item, $key) use ($order) {
                $order->orderLines()->create(
                    [
                        'order_id' => $order->id,
                        'order_line_quantity' => $cart_item->cart_item_quantity,
                        'order_line_price' => $cart_item->cart_item_quantity * $cart_item->productItem->product_item_price,
                        'product_item_id' => $cart_item->productItem->id
                    ]
                );
            });
            $total_price = $order->orderLines->sum(fn($orderLine)=>$orderLine->order_line_price);
            return redirect()->route('checkout.auth.form')->withInput([
                'order_id' => $order->id,
                'total_price' => $total_price + $order->shippingMethod->shipping_method_price
            ], true);

        } else {
            $guest_order = GuestOrder::create([
                'shipping_method_id' => $request->shipping_method_id
            ]);

            $guest_order_details = [];
            foreach (Cart::getItems() as $cart_item) {
                $guest_order_details[] = [
                    'order_id' => $guest_order->id,
                    'product_name' => $cart_item['product_name'],
                    'product_item_id' => $cart_item['product_item_id'],
                    'order_line_quantity' => $cart_item['quantity'],
                    'order_line_price' => $cart_item['quantity']
                        * $cart_item['product_item_price']
                ];
            }
            $total_price = array_reduce($guest_order_details, function ($carry, $item) {
                return $carry + $item['order_line_price'];
            });

            $guest_order->guest_order_details = json_encode($guest_order_details);
            $guest_order->save();

            return redirect()->route('checkout.guest.form')->withInput([
                'guest_order_id' => $guest_order->id,
                'total_price' => $total_price + $guest_order->shippingMethod->shipping_method_price
            ], true);
        }
    }
}
