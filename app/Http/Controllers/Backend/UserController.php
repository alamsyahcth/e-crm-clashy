<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Hash;
use Auth;
use DB;

class UserController extends Controller
{
    protected $type = 'backend';
    protected $role = 'admin';
    protected $page = 'User';
    protected $path = 'user';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = User::where('role', 1)->orderBy('id', 'DESC')->get();
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
        $role = $this->role;
        $page = $this->page;
        $path = $this->path;
        return view($this->type.'.'.$this->path.'.create', compact(['role', 'page', 'path']));
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
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'phone' => 'required|numeric',
        ]);

        if ($validation) {
            DB::beginTransaction();
            try{
                $data = New User;
                $data->name = $request->name;
                $data->email = $request->email;
                $data->phone = $request->phone;
                $data->role = 1;
                $data->password = Hash::make('admin1234');
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
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $data = User::find(Auth::user()->id);
        $role = $this->role;
        $page = $this->page;
        $path = $this->path;
        return view($this->type.'.'.$this->path.'.edit', compact(['data', 'role', 'page', 'path']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validation = $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.Auth::user()->id,
            'phone' => 'required|numeric',
        ]);

        if ($validation) {
            DB::beginTransaction();
            try{
                $data = User::find(Auth::user()->id);
                $data->name = $request->name;
                $data->email = $request->email;
                $data->phone = $request->phone;
                $data->role = 1;
                $data->password = $data->password;
                $data->save();
                DB::commit();
                notify()->success('Berhasil Menambahkan Data');
                return redirect($this->role.'/'.str_replace(' ', '-', strtolower($this->page)).'/edit');
            } catch (\Exception $err) {
                DB::rollback();
                notify()->error('Gagal Menambahkan Data');
                return redirect($this->role.'/'.str_replace(' ', '-', strtolower($this->page)).'/edit');
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
        $data = User::find($id);
        if ($data->delete()) {
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
     * @return \Illuminate\Http\Response
     */
    public function changePassword()
    {
        $data = User::find(Auth::user()->id);
        $role = $this->role;
        $page = $this->page;
        $path = $this->path;
        return view($this->type.'.'.$this->path.'.change-password', compact(['data', 'role', 'page', 'path']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleChangePassword(Request $request) {
        $validate = $this->validate($request, [
            'old_password' => 'required|string',
            'new_password' => 'required|string|min:8|same:confirm_new_password',
            'confirm_new_password' => 'required|string',
        ]);
        if($validate) {
            if(Hash::check($request->old_password, Auth::user()->password)) {
                User::where('id', Auth::user()->id)->update(['password' => Hash::make($request->new_password)]);
                notify()->success('Berhasil Mengubah Password');
                return redirect($this->role.'/'.str_replace(' ', '-', strtolower($this->page)).'/change-password');
            } else {
                notify()->error('Gagal Mengubah Password');
                return redirect($this->role.'/'.str_replace(' ', '-', strtolower($this->page)).'/change-password');
            }
        }
    }

}
