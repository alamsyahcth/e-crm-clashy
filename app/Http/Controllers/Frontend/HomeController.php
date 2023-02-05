<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use App\Models\CategoryProduct;
use App\Models\Product;
use App\Models\Schedule;
use App\Models\User;
use App\Models\ScheduleDetail;
use App\Models\Employee;
use App\Models\Book;
use App\Models\BookRate;
use DB;
use Auth;
use Crypt;
use Hash;
use Carbon\Carbon;

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

        if(Auth::check() == true) {
            $bookDone = ScheduleDetail::join('books','books.schedule_detail_id','=','schedule_details.id')
                    ->join('schedules','schedules.id','=','schedule_details.schedule_id')
                    ->join('employees','employees.id','=','schedule_details.employee_id')
                    ->join('products','products.id','=','books.product_id')
                    ->join('users','users.id','=','books.user_id')
                    ->select('books.id as book_id', 'invoice', 'products.name as product_name', 'products.price as product_price', 'products.image as product_image', 'books.invoice', 'employees.name as employee_name', 'schedules.day as schedule_day', 'schedules.date as schedule_date','schedule_details.time_start', 'schedule_details.time_end', 'books.created_at as books_created_at','users.name as user_name', 'books.status as book_status', 'is_promo', 'payment_status')
                    ->where('books.user_id', Auth::user()->id)
                    ->where('books.status', '=', 1)
                    ->where('books.rate_status', '=', null)
                    ->get();
        } else {
            $bookDone = null;
        }
        $countBookDone = $bookDone->count();
        return view('frontend.home', compact([
            'banner',
            'category',
            'product',
            'bookDone',
            'countBookDone',
        ]));
    }

    public function bookRate($book_id, $book_rate) 
    {
        $data = Book::where('id', $book_id)->update(['rate_status' => $book_rate]);

        if($data) {
            $res = [
                'success' => true,
                'message' => 'data saved succesfully'
            ];
            return response()->json($res);
        } else {
            $res = [
                'success' => false,
                'message' => 'data saved unsuccessfully'
            ];
            return response()->json($res);
        }
    }
}
