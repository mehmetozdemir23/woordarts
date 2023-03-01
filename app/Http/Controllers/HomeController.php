<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
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

        return view('home');
    }
}
