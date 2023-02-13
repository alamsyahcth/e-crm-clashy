<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;

class ArticleController extends Controller
{
    public function index() {
        $data = Article::all();
        return view('frontend.article.index', compact([
            'data'
        ]));
    }

    public function getDetail($id) {
        $data = Article::where('id', $id)->first();
        return view('frontend.article.detail', compact([
            'data'
        ]));
    }
}
