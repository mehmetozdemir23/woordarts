<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductItem extends Model
{
    use HasFactory;

    protected $fillable = ['product_item_sku', 'product_item_quantity_in_stock', 'product_item_price'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function images(){
        return $this->hasMany(ProductItemImage::class);
    }

    public function cartItems(){
        return $this->hasMany(CartItem::class);
    }

    protected function inStock(): Attribute
    {
        return Attribute::make(
            get: fn ($value,$attributes) => $attributes['product_item_quantity_in_stock'] > 0,
        );
    }

    public function thumbnail()
    {
        return $this->images->first()->product_item_image_path;
    }
}
