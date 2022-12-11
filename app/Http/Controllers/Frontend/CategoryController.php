<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CategoryProduct;
use App\Models\Product;

class CategoryController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($slug) 
    {
        $category = CategoryProduct::where('slug', $slug)->first();
        $allCategory = CategoryProduct::get();
        if($slug == 'produk') {
            $product = Product::paginate(1);
        } else if($slug == 'login') {
            return view('auth.login');
        } else if($slug == 'register') {
            return view('auth.register');
        } else {
            $product = Product::where('category_id', $category->id)->paginate(1);   
        }
        return view('frontend.category', compact([
            'category',
            'allCategory',
            'product',
        ]));
    }
}
