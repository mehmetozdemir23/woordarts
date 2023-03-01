<?php

namespace App\Http\Controllers;


use App\Models\Product;
use App\Models\Category;
use App\Models\ProductItem;
use Illuminate\Http\Request;


class ProductItemController extends Controller
{
    public function index(Request $request){
        $category_id = $request->category_id;
        if($category_id)
        {
            $products = Product::where('category_id',$category_id)->with('item')->get();
            $active_category = Category::find($category_id);
        }
        else{

            $products = Product::with('item')->all();
            $active_category = Category::first();
        }

        return view('products.index',[
            'categories'=>Category::all(),
            'active_category'=>$active_category,
            'products'=>$products
        ]);
    }

    public function show($id){
        return view('product_items.show',[
            'productItem'=>ProductItem::find($id),
        ]);
    }
}
