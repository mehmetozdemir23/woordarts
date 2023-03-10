<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show($id){
        return view('products.index',[
            'categories'=>Category::all(),
            'products'=>Product::where('category_id',$id)->with('item')->get()
        ]);
    }
}
