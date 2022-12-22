<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use App\Models\CategoryProduct;
use App\Models\Product;
use App\Models\Schedule;

class HomeController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() 
    {
        $banner = Banner::get();
        $category = CategoryProduct::get();
        $product = Product::where('recomendation', 1)->paginate(1);
        return view('frontend.home', compact([
            'banner',
            'category',
            'product'
        ]));
    }
}
