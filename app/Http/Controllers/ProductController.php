<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $category_id = $request->category_id;
        if ($category_id) {
            $products = Product::where('category_id', $category_id)->get();
            $active_category = Category::find($category_id);
        } else {

            $active_category = Category::first();
            $products = Product::whereHas('category', function ($query) use ($active_category) {
                $query->where('id', $active_category->id);
            })->get();
        }

        return view('products.index', [
            'categories' => Category::all(),
            'active_category' => $active_category,
            'products' => $products
        ]);
    }
    public function show($id)
    {
        return view('products.show', [
            'product' => Product::with('item')->find($id),
        ]);
    }
}
