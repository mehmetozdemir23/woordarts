<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderLine extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function productItem(){
        return $this->belongsTo(ProductItem::class);
    }
}
