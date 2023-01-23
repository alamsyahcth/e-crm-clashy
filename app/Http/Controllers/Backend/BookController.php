<?php

namespace App\Http\Controllers\Backend;

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

class BookController extends Controller
{
    protected $type = 'backend';
    protected $role = 'admin';
    protected $page = 'Booking';
    protected $path = 'book';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = ScheduleDetail::join('books','books.schedule_detail_id','=','schedule_details.id')
                ->join('schedules','schedules.id','=','schedule_details.schedule_id')
                ->join('employees','employees.id','=','schedule_details.employee_id')
                ->join('products','products.id','=','books.product_id')
                ->join('users','users.id','=','books.user_id')
                ->select('books.id as book_id', 'products.name as product_name', 'products.price as product_price', 'products.image as product_image', 'books.invoice', 'employees.name as employee_name', 'schedules.day as schedule_day', 'schedules.date as schedule_date','schedule_details.time_start', 'schedule_details.time_end', 'books.created_at as books_created_at','users.name as user_name', 'books.status as book_status', 'is_promo', 'transfer_date','account_number','to_bank','on_behalf_of','total_transfers','remaining_payment','evidence_of_transfer','payment_status')
                ->orderBy('books.id', 'desc')
                ->get();
        $role = $this->role;
        $page = $this->page;
        $path = $this->path;
        return view($this->type.'.'.$this->path.'.index', compact(['data', 'role', 'page', 'path']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = ScheduleDetail::join('books','books.schedule_detail_id','=','schedule_details.id')
                ->join('schedules','schedules.id','=','schedule_details.schedule_id')
                ->join('employees','employees.id','=','schedule_details.employee_id')
                ->join('products','products.id','=','books.product_id')
                ->join('users','users.id','=','books.user_id')
                ->select('books.id as book_id', 'products.name as product_name', 'products.price as product_price', 'products.image as product_image', 'books.invoice', 'employees.name as employee_name', 'employees.email as employee_email', 'employees.phone as employee_phone','schedules.day as schedule_day', 'schedules.status as schedule_status', 'schedules.date as schedule_date','schedule_details.time_start', 'schedule_details.time_end', 'books.created_at as books_created_at', 'users.name as user_name', 'users.email as user_email', 'users.phone as user_phone', 'books.status as book_status', 'is_promo')
                ->where('books.id', $id)
                ->first();
        $role = $this->role;
        $page = $this->page;
        $path = $this->path;
        return view($this->type.'.'.$this->path.'.show', compact(['data', 'role', 'page', 'path']));
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $status
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function action($status, $id)
    {
        $data = ScheduleDetail::join('books','books.schedule_detail_id','=','schedule_details.id')->where('books.id',$id)->first();

        if($status == 'cancel') {
            ScheduleDetail::where('id', $data->schedule_detail_id)->update(['status' => 3]);
            Book::where('id',$id)->update(['status' => 2]);
        }

        if($status == 'present') {
            $getPoint = User::where('id', $data->user_id)->first();
            ScheduleDetail::where('id', $data->schedule_detail_id)->update(['status' => 2]);
            Book::where('id',$id)->update(['status' => 1]);
            User::where('id',$getPoint->id)->update(['point' => ($getPoint->point+5)]);
        }

        return redirect($this->role.'/'.str_replace(' ', '-', strtolower($this->page)).'/show/'.$id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function actionPayment(Request $request)
    {
        if($request->get_action == '1') {
            $data = Book::where('id', $request->id)->update([
                'payment_status' => 2
            ]);
            notify()->success('Berhasil Mengubah Data');
            return redirect($this->role.'/'.str_replace(' ', '-', strtolower($this->page)));
        } else if ($request->get_action == '2') {
            $data = Book::where('id', $request->id)->update([
                'payment_status' => 0
            ]);
            notify()->success('Berhasil Mengubah Data');
            return redirect($this->role.'/'.str_replace(' ', '-', strtolower($this->page)));
        } else {
            notify()->error('Gagal Mengubah Data');
            return redirect($this->role.'/'.str_replace(' ', '-', strtolower($this->page)));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
