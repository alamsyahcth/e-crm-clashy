<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use App\Models\Product;
use DB;
use File;

class BannerController extends Controller
{
    protected $type = 'backend';
    protected $role = 'admin';
    protected $page = 'Banner';
    protected $path = 'banner';
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Banner::orderBy('id', 'DESC')->get();
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
        $product = Product::get();
        $role = $this->role;
        $page = $this->page;
        $path = $this->path;
        return view($this->type.'.'.$this->path.'.create', compact(['role', 'page', 'path', 'product']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = $this->validate($request, [
            'image' => 'required|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        if ($validation) {
            DB::beginTransaction();
            try{
                $image = $this->handleImage($request->file('image'), $this->path, null);
                $data = new Banner;
                $data->title = $request->title;
                $data->description = $request->description;
                $data->link = $request->link;
                $data->image = $image;
                $data->save();
                DB::commit();
                notify()->success('Berhasil Menambahkan Data');
                return redirect($this->role.'/'.str_replace(' ', '-', strtolower($this->page)));
            } catch (\Exception $err) {
                DB::rollback();
                notify()->error('Gagal Menambahkan Data');
                return redirect($this->role.'/'.str_replace(' ', '-', strtolower($this->page)));
            }
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
        $product = Product::get();
        $data = Banner::find($id);
        $role = $this->role;
        $page = $this->page;
        $path = $this->path;
        return view($this->type.'.'.$this->path.'.edit', compact(['data', 'role', 'page', 'path', 'product']));
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
        $validation = $this->validate($request, [
            'title' => 'nullable',
            'image' => 'mimes:jpg,png,jpeg|max:2048',
        ]);
        
        if ($validation) {
            DB::beginTransaction();
            try{
                if($request->image != null) {
                    $image = $this->handleImage($request->file('image'), $this->path, $request->image_old);
                } else {
                    $image = $request->image_old;
                }
                $data = Banner::find($id);
                $data->title = $request->title;
                $data->description = $request->description;
                $data->link = $request->link;
                $data->image = $image;
                $data->save();
                DB::commit();
                notify()->success('Berhasil Menambahkan Data');
                return redirect($this->role.'/'.str_replace(' ', '-', strtolower($this->page)));
            } catch (\Exception $err) {
                DB::rollback();
                notify()->error('Gagal Menambahkan Data');
                return redirect($this->role.'/'.str_replace(' ', '-', strtolower($this->page)));
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Banner::find($id);
        if ($data->delete()) {
            File::delete(base_path().'/public/img/'.$this->path.'/'.$data->image);
            notify()->success('Berhasil Menghapus Data');
            return redirect($this->role.'/'.str_replace(' ', '-', strtolower($this->page)));
        } else {
            notify()->error('Gagal Menghapus Data');
            return redirect($this->role.'/'.str_replace(' ', '-', strtolower($this->page)));
        }
    }

     /**
     * Show the form for editing the specified resource.
     *
     * @param string $data
     * @param string $path
     * @param string $olData
     * @return \Illuminate\Http\Response
     */
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
