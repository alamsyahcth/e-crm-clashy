<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\CategoryProduct;
use App\Models\Discussion;
use App\Models\DisscussionReply;
use DB;
use Auth;

class ProductController extends Controller
{
    public function index($slug) {
        $product = Product::where('slug', $slug)->first();
        $getCategoryProduct = CategoryProduct::where('id', $product->category_id)->first();
        $recomendedProduct = Product::where('recomendation', 1)->skip(0)->take(3)->get();
        $discussion = Discussion::join('users','users.id','=','discussions.user_id')->where('product_id', $product->id)->orderBy('discussions.id', 'desc');
        $dataDiscussion = $discussion->get();
        $countDiscussion = $discussion->count();
        $discussionReplies = DisscussionReply::join('discussions','discussions.id', '=', 'disscussion_replies.discussion_id')->where('discussions.id', $product->id)->get();
        return view('frontend.product', compact([
            'product',
            'getCategoryProduct',
            'recomendedProduct',
            'dataDiscussion',
            'countDiscussion',
            'discussionReplies'
        ]));
    }

    public function store(Request $request, $id)
    {
        $getSlug = Product::find($id);
        DB::beginTransaction();
        try{
            $data = new Discussion;
            $data->product_id = $id;
            $data->user_id = Auth::user()->id;
            $data->message = $request->message;
            $data->save();
            DB::Commit();
            return redirect('produk/'.$getSlug->slug);
        } catch(\Exception $err) {
            return redirect('produk/'.$getSlug->slug);
        }
    }
}
