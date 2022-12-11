<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CategoryProduct;
use App\Models\Product;
use DB;
use File;

class ProductController extends Controller
{
    protected $type = 'backend';
    protected $role = 'admin';
    protected $page = 'Produk';
    protected $path = 'product';

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
        $category = CategoryProduct::get();
        $role = $this->role;
        $page = $this->page;
        $path = $this->path;
        return view($this->type.'.'.$this->path.'.create', compact(['role', 'page', 'path', 'category']));
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
            'category_id' => 'required',
            'slug' => 'required|unique:products',
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'recomendation' => 'required',
            'image' => 'required|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        if ($validation) {
            DB::beginTransaction();
            try{
                $image = $this->handleImage($request->file('image'), $this->path, null);
                $data = new Product;
                $data->category_id = $request->category_id;
                $data->slug = $request->slug;
                $data->name = $request->name;
                $data->description = $request->description;
                $data->price = $request->price;
                $data->status = 1;
                $data->recomendation = $request->recomendation;
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
        $data = Product::find($id);
        $category = CategoryProduct::get();
        $role = $this->role;
        $page = $this->page;
        $path = $this->path;
        return view($this->type.'.'.$this->path.'.edit', compact(['data', 'role', 'page', 'path', 'category']));
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
            'category_id' => 'required',
            'slug' => 'required|unique:products,slug,'.$id,
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'status' => 'required',
            'recomendation' => 'required',
            'image' => 'image|mimes:jpg,png,jpeg|max:2048',
        ]);

        if ($validation) {
            DB::beginTransaction();
            try{
                if($request->image != null) {
                    $image = $this->handleImage($request->file('image'), $this->path, $request->image_old);
                } else {
                    $image = $request->image_old;
                }
                $data = Product::find($id);
                $data->category_id = $request->category_id;
                $data->slug = $request->slug;
                $data->name = $request->name;
                $data->description = $request->description;
                $data->price = $request->price;
                $data->status = $request->status;
                $data->recomendation = $request->recomendation;
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
        $data = Product::find($id);
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
