<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Schedule;
use App\Models\Product;
use App\Models\User;
use App\Models\ScheduleDetail;
use App\Models\Employee;
use App\Models\Book;
use DB;
use Auth;
use Crypt;
use Barryvdh\DomPDF\Facade\Pdf;
use File;

class BookController extends Controller
{
    public function __construct(){
        $this->middleware(['customer']);
    }

    public function index(Request $request) {
        return redirect('book/search/'.$request->date.'/'.$request->productSlug);
    }

    public function search($date, $slug) {
        $schedule = Schedule::where('date',$date)->first();
        $product = Product::where('slug', $slug)->first();
        $scheduleList = ScheduleDetail::where('schedule_id', $schedule->id)->where('status', 0)->orderBy('time_start', 'asc')->get();
        $employee = Employee::where('status', 1)->get();
        $getSchedule = Schedule::where('status',1)->get();
        return view('frontend.book', compact([
            'schedule',
            'product',
            'scheduleList',
            'employee',
            'getSchedule'
        ]));
    }

    public function store(Request $request) {
        $productSlug = Product::find($request->product_id);
        $validation = $this->validate($request, [
            'schedule_detail_id' => 'required',
            'user_id' => 'required',
            'product_id' => 'required',
        ]);

        $user = User::where('id',$request->user_id)->first();
        if($user->point == 30) {
            $is_promo = 'yes';
        } else {
            $is_promo = 'no';
        }

        if($validation) {
            DB::beginTransaction();
            try{
                $data = new Book;
                $data->schedule_detail_id = $request->schedule_detail_id;
                $data->user_id = $request->user_id;
                $data->product_id = $request->product_id;
                $data->invoice = 'Book/'.date('Y/M/d').'/'.time().$request->schedule_detail_id.'/'.$request->user_id;
                $data->status = 0;
                $data->is_promo = $is_promo;
                $data->save();
                DB::commit();
                ScheduleDetail::where('id',$request->schedule_detail_id)->update(['status' => 1]);
                if($user->point == 30) {
                    User::where('id', $request->user_id)->update(['point' => 0]);
                }
                return redirect('book/success/'.Crypt::encryptString($data->id));
            } catch (\Exception $err) {
                DB::rollback();
                return redirect('book/search/'.$request->date_pick.'/'.$productSlug->slug);
            }
        }
    }

    public function bookSuccess($id) {
        $book = Book::find(Crypt::decryptString($id));
        $dataBook = $this->getBook($book->id);
        return view('frontend.bookSuccess', compact([
            'dataBook'
        ]));
    }

    public function printPdf($id) {
        $book = Book::find(Crypt::decryptString($id));
        $data = $this->getBook($book->id);
        $title = 'Cetak Bukti Booking-'.$data->invoice;
        $pdf = Pdf::loadView('frontend.bookPrint', compact([
            'data',
            'title'
        ]));
        return $pdf->stream();
    }

    protected function getBook($id) {
        return  ScheduleDetail::join('books','books.schedule_detail_id','=','schedule_details.id')
                ->join('schedules','schedules.id','=','schedule_details.schedule_id')
                ->join('employees','employees.id','=','schedule_details.employee_id')
                ->join('products','products.id','=','books.product_id')
                ->join('users','users.id','=','books.user_id')
                ->where('books.id','=',$id)
                ->select('books.id as book_id', 'products.name as product_name', 'products.price as product_price', 'products.image as product_image', 'books.invoice', 'employees.name as employee_name', 'employees.email as employee_email', 'employees.phone as employee_phone','schedules.day as schedule_day', 'schedules.date as schedule_date','schedule_details.time_start', 'schedule_details.time_end', 'books.created_at as books_created_at', 'users.name as user_name', 'users.email as user_email', 'users.phone as user_phone', 'books.status as book_status', 'is_promo', 'payment_status')
                ->first();
    }
    
    public function payment(Request $request) {
        $image = $this->handleImage($request->file('evidence_of_transfer'), 'payment', null);
        $data = Book::where('id', $request->id)->update([
            'transfer_date' => date('Y-m-d'),
            'account_number' => $request->account_number,
            'to_bank' => $request->to_bank,
            'on_behalf_of' => $request->on_behalf_of,
            'total_transfers' => $request->total_transfers,
            'remaining_payment' => $request->remaining_payment,
            'evidence_of_transfer' => $image,
            'payment_status' => 1,
        ]);

        if($data) {
            return redirect('profil/history-booking');
        }
    }

    public function handleImage($data, $path, $oldData)
    {
        $file = $data;
        $name = $path.'-'.date('ymd').rand(100, 999).$file->getClientOriginalName();
        $to = 'img/'.$path;
        $file->move($to, $name);
        File::delete(base_path().'/public/img/'.$path.'/'.$oldData);

        return $name;
    }
}
