<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\CartItem;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartItemController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity_to_add' => 'required|numeric'
        ]);

        $product = Product::find($request->product_id);
        $cart_item = $product->item->cartItem;

        if (Auth::check()) {

            $user_cart = Auth::user()->cart;

            if (!$user_cart->items->contains($cart_item)) {
                $user_cart->items()->save(CartItem::create([
                    'cart_id' => $user_cart->id,
                    'product_item_id' => $product->item->id,
                    'cart_item_quantity' => $request->quantity_to_add
                ]));
            }
        } else {
            if($request->session()->exists('cart')){
                $cart = $request->session()->get('cart');
                if($cart && Arr::exists($cart,$product->id))
                    $cart[$product->id]++;
                else
                    $cart[$product->id] = $request->quantity_to_add;
                $request->session()->put('cart',$cart);
            }else{
                $cart[$product->id] = $request->quantity_to_add;
                $request->session()->put('cart',$cart);
            }

        }

        return back();
    }

    public function update(Request $request)
    {
        $request->validate([
            'cart_item' => 'required|array|min:2|max:2',
            'cart_item.*' => 'required|numeric'
        ]);


        $cart_item = CartItem::find($request->cart_item['id']);

        if ($cart_item) {
            $cart_item->cart_item_quantity = $request->cart_item['quantity'];
            $cart_item->save();
        }

        return redirect(url()->previous() . '#cart-items');
    }

    public function destroy(Request $request)
    {
        $request->validate([
            'cart_item_id' => 'required|exists:cart_items,id'
        ]);

        CartItem::find($request->cart_item_id)->delete();

        return back();
    }
}
