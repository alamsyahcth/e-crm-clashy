<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\Discussion;
use App\Models\DisscussionReply;

class DiscussionController extends Controller
{
    protected $type = 'backend';
    protected $role = 'admin';
    protected $page = 'Diskusi';
    protected $path = 'discussion';
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
    public function store(Request $request, $id)
    {
        $discussion = Discussion::where('id', $id)->first();
        $data = new DisscussionReply;
        $data->discussion_id = $id;
        $data->message = $request->message;
        if($data->save()) {
            Discussion::where('id', $id)->update(['status' => 1]);
            notify()->success('Berhasil Menambahkan Data');
            return redirect($this->role.'/'.str_replace(' ', '-', strtolower($this->page)).'/'.$discussion->product_id);
        } else {
            notify()->error('Gagal Menambahkan Data');
            return redirect($this->role.'/'.str_replace(' ', '-', strtolower($this->page)).'/'.$discussion->product_id);
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
        $data = Discussion::join('users','users.id','=','discussions.user_id')
                ->where('product_id', $id)
                ->orderBy('discussions.id', 'desc')
                ->select('users.name','discussions.id','discussions.message', 'discussions.created_at','discussions.status')
                ->get();
        $replies = DisscussionReply::join('discussions','discussions.id','=','disscussion_replies.discussion_id')->select('*', 'disscussion_replies.message as disscussion_replies_message')->where('discussions.product_id',$id)->get();
        $product = Product::find($id);
        $role = $this->role;
        $page = $this->page;
        $path = $this->path;
        return view($this->type.'.'.$this->path.'.show', compact(['data', 'role', 'page', 'path', 'replies', 'product']));
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
