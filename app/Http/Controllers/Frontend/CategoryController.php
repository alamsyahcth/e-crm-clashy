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
        } else if ($slug == 'admin') {
            return redirect('admin/dashboard');
        } else if ($slug == 'book') {
            return abort(404);
        } else if ($slug == 'profil') {
            return redirect('profil/edit-profil');
        } else {
            $dataProduct = Product::where('category_id', $category->id);
            if($dataProduct->count() == 0) {
                return abort(404);
            } else {
                $product = $dataProduct->paginate(1);
            }
        }
        return view('frontend.category', compact([
            'category',
            'allCategory',
            'product',
        ]));
    }
}
