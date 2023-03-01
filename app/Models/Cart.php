<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Cart extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(CartItem::class);
    }


    private static function createCartSideBarItem($product_item_id, $quantity)
    {

        $product_item = ProductItem::find($product_item_id);
        $product = $product_item->product;

        return
            [
                'product_id'=>$product->id,
                'product_item_id' => $product_item->id,
                'product_item_thumbnail' => $product_item->thumbnail(),
                'product_name' => $product->product_name,
                'product_item_price' => $product_item->product_item_price,
                'quantity' => $quantity
            ];
    }

    public static function getItems()
    {
        $cart_items_array = [];
        if (Auth::check()) {
            $cart_items = Auth::user()->cart->items;
            foreach ($cart_items as $cart_item) {
                $product_item_id = $cart_item->productItem->id;
                $quantity = $cart_item->cart_item_quantity;
                $cart_items_array[] = self::createCartSideBarItem($product_item_id, $quantity);
            }
        } else {
            $cart_items = request()->session()->get('cart', []);
            foreach ($cart_items as $product_item_id=>$quantity) {
                $cart_items_array[] = self::createCartSideBarItem($product_item_id, $quantity);
            }
        }
        return $cart_items_array;
    }

    public static function reset(){
        if(Auth::check()){
            Auth::user()->cart->items()->delete();
        }
        else {
            session()->forget('cart');
        }
    }
}
