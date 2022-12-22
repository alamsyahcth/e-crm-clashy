<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Schedule;
use App\Models\Product;
use App\Models\User;
use App\Models\ScheduleDetail;
use App\Models\Employee;
use App\Models\Book;
use App\Models\Complain;
use Barryvdh\DomPDF\Facade\Pdf;
use DB;

class ReportController extends Controller
{
    protected $type = 'backend';
    protected $role = 'admin';
    protected $page = 'Laporan';
    protected $path = 'report';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($slug)
    {
        if($slug == 'laporan-register') {
            $data = 'register';
        } else if($slug == 'laporan-review') {
            $data = 'review';
        } else if($slug == 'laporan-data-booking') {
            $data = 'booking';
        } else {
            $data = 'false';
        }

        if($data == false) {
            return abort(404);
        } else {
            $role = $this->role;
            $page = $this->page;
            $path = $this->path;
            return view($this->type.'.'.$this->path.'.index', compact(['data', 'role', 'page', 'path']));
        }
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
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function export(Request $request, $slug)
    {
        $validate = $this->validate($request, [
            'first_date' => 'required|before:last_date',
            'last_date' => 'required'
        ]);

        if($validate) {
            if($slug == 'register') {
                $data = User::where('role', 2)
                        ->where('created_at','>=',$request->first_date)
                        ->where('created_at','<=',$request->last_date)
                        ->get();
                $reportName = 'Laporan Data Register';
    
            } else if($slug == 'review') {
                $data = Review::join('products','products.id','=','reviews.product_id')
                        ->where('reviews.created_at','>=',$request->first_date)
                        ->where('reviews.created_at','<=',$request->last_date)
                        ->select('products.name', DB::raw('SUM(reviews.stars) as review_stars'), DB::raw('COUNT(reviews.stars) as count_stars'), DB::raw('SUM(reviews.stars)/COUNT(reviews.stars) as average_stars'))
                        ->groupBy('products.id')
                        ->get();
                $reportName = 'Laporan Data Review Produk';
            } else if($slug == 'booking') {
                $data = ScheduleDetail::join('books','books.schedule_detail_id','=','schedule_details.id')
                        ->join('schedules','schedules.id','=','schedule_details.schedule_id')
                        ->join('employees','employees.id','=','schedule_details.employee_id')
                        ->join('products','products.id','=','books.product_id')
                        ->join('users','users.id','=','books.user_id')
                        ->select('books.id as book_id', 'products.name as product_name', 'products.price as product_price', 'products.image as product_image', 'books.invoice', 'employees.name as employee_name', 'schedules.day as schedule_day', 'schedules.date as schedule_date','schedule_details.time_start', 'schedule_details.time_end', 'books.created_at as books_created_at','users.name as user_name', 'books.status as book_status', 'is_promo')
                        ->where('books.created_at','>=',$request->first_date)
                        ->where('books.created_at','<=',$request->last_date)
                        ->get();
                $reportName = 'Laporan Data Register';
            } else {
                $data = 'false';
            }

            $firstDate = $request->first_date;
            $lastDate = $request->last_date; 

            $pdf = Pdf::loadView('backend.report.pdf', compact([
                'data',
                'firstDate',
                'lastDate',
                'reportName',
                'slug'
            ]))->setPaper('a4', 'landscape');
            return $pdf->stream();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
