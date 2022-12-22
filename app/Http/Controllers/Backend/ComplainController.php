<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\Complain;
use DB;

class ComplainController extends Controller
{
    protected $type = 'backend';
    protected $role = 'admin';
    protected $page = 'Keluhan';
    protected $path = 'complain';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Product::orderBy('id', 'DESC')->get();
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
    public function store(Request $request, $id, $userId)
    {
        $product = Product::find($id);
        $user = User::find($userId);

        DB::beginTransaction();
        try{
            $data = new Complain;
            $data->product_id = $id;
            $data->user_id = $userId;
            $data->is_admin = true;
            $data->is_customer = false;
            $data->message = $request->message;
            $data->save();
            DB::Commit();
            return redirect($this->role.'/'.str_replace(' ', '-', strtolower($this->page)).'/'.$product->id.'/'.$user->id);
        } catch(\Exception $err) {
            return redirect($this->role.'/'.str_replace(' ', '-', strtolower($this->page)).'/'.$product->id.'/'.$user->id);
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
        $data = Complain::join('products','products.id','=','complains.product_id')
                ->join('users','users.id','=','complains.user_id')
                ->where('is_customer', 1)
                ->select('complains.user_id', 'users.name', 'users.email', 'users.phone')
                ->groupBy('complains.user_id')
                ->get();
        $product = Product::find($id);
        $role = $this->role;
        $page = $this->page;
        $path = $this->path;
        return view($this->type.'.'.$this->path.'.show', compact(['data', 'role', 'page', 'path', 'product']));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showCustomer($id,$userId)
    {
        $data = Complain::where('user_id', $userId)->where('product_id', $id)->select('*')->orderBy('id', 'desc')->get();
        $product = Product::find($id);
        $customer = User::find($userId);
        $role = $this->role;
        $page = $this->page;
        $path = $this->path;
        return view($this->type.'.'.$this->path.'.showCustomer', compact(['data', 'role', 'page', 'path', 'product', 'customer']));
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
