<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductItemImage extends Model
{
    use HasFactory;

    public function productItem(){
        return $this->belongsTo(ProductItem::class);
    }
}
