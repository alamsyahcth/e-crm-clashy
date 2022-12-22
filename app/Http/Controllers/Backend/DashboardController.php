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

class DashboardController extends Controller
{
    protected $type = 'backend';
    protected $role = 'admin';
    protected $page = 'Dahsboard';
    protected $path = 'dashboard';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $getStars = Review::sum('stars')/Review::count();
        $dataStars = array();
        for($i=1; $i<=5; $i++) {
            $dataStars[$i] = Review::where('stars', $i)->count();
        }
        $booking = Book::count();
        $product = Product::count();
        $customer = User::where('role', 2)->count();
        $schedule = Schedule::where('status', 1)->count();
        $complain = Complain::groupBy('user_id')->count();
        $role = $this->role;
        $page = $this->page;
        $path = $this->path;
        return view($this->type.'.'.$this->path.'.index', compact([
            'role', 
            'page', 
            'path',
            'getStars',
            'dataStars',
            'booking',
            'product',
            'customer',
            'schedule',
            'complain'
        ]));
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
