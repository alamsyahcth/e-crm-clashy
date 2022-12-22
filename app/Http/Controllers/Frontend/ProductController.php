<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\CategoryProduct;
use App\Models\Discussion;
use App\Models\DisscussionReply;
use App\Models\Review;
use App\Models\Complain;
use App\Models\Schedule;
use DB;
use Auth;

class ProductController extends Controller
{
    public function index($slug) {
        $product = Product::where('slug', $slug)->first();
        $getCategoryProduct = CategoryProduct::where('id', $product->category_id)->first();
        $recomendedProduct = Product::where('recomendation', 1)->skip(0)->take(3)->get();
        $discussion = Discussion::join('users','users.id','=','discussions.user_id')->where('product_id', $product->id)->orderBy('discussions.id', 'desc');
        $dataDiscussion = $discussion->select('*', 'discussions.id as discussion_id')->get();
        $countDiscussion = $discussion->count();
        $discussionReplies = DisscussionReply::get();
        $getReview = Review::where('product_id', $product->id);
        $getStars = $getReview->sum('stars')/$getReview->count();
        if(Auth::check() == true) {
            $showReview = Review::where('product_id', $product->id)->where('user_id', Auth::user()->id)->first();
            $complain = Complain::join('users','users.id','=','complains.user_id')->where('product_id', $product->id)->where('users.id', Auth::user()->id)->orderBy('complains.id', 'asc')->get();
            $getSchedule = Schedule::where('status',1)->get();
        } else {
            $showReview = null;
            $complain = null;
            $getSchedule = null;
        }
        return view('frontend.product', compact([
            'product',
            'getCategoryProduct',
            'recomendedProduct',
            'dataDiscussion',
            'countDiscussion',
            'discussionReplies',
            'showReview',
            'complain',
            'getStars',
            'getSchedule'
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
            $data->status = 0;
            $data->save();
            DB::Commit();
            return redirect('produk/'.$getSlug->slug);
        } catch(\Exception $err) {
            return redirect('produk/'.$getSlug->slug);
        }
    }

    public function review(Request $request, $id)
    {
        $getSlug = Product::find($id);
        $getReview = Review::where('product_id', $id)->where('user_id', Auth::user()->id);
        if($getReview->count() == 0) {
            $data = new Review;
        } else if ($getReview->count() == 1) {
            $data = Review::find($getReview->first()->id);
        }
        $data->product_id = $id;
        $data->user_id = Auth::user()->id;
        $data->stars = $request->stars;
        $data->comment = $request->comment;
        $data->save();
        return redirect('produk/'.$getSlug->slug);
    }

    public function complain(Request $request, $id)
    {
        $getSlug = Product::find($id);
        DB::beginTransaction();
        try{
            $data = new Complain;
            $data->product_id = $id;
            $data->user_id = Auth::user()->id;
            $data->is_admin = false;
            $data->is_customer = true;
            $data->message = $request->message;
            $data->save();
            DB::Commit();
            return redirect('produk/'.$getSlug->slug);
        } catch(\Exception $err) {
            return redirect('produk/'.$getSlug->slug);
        }
    }
}
