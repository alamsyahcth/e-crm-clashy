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
use Hash;

class ProfileController extends Controller
{
    public function editProfile() {
        $data = User::where('id', Auth::user()->id)->first();
        return view('frontend.profile.index', compact([
            'data'
        ]));
    }

    public function updateProfile(Request $request) {
        $validate = $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.Auth::user()->id,
            'phone' => 'required|numeric',
        ]);

        if($validate) {
            $data = User::where('id', Auth::user()->id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
            ]);
            if($data) {
                return redirect('profil/edit-profil')->with('success', 'profil berhasil diubah');
            } else {
                return redirect('profil/edit-profil')->with('error', 'profil gagal diubah');
            }
        }
    }

    public function editPassword() {
        return view('frontend.profile.index');
    }

    public function updatePassword(Request $request) {
         $validate = $this->validate($request, [
            'old_password' => 'required|string',
            'new_password' => 'required|string|min:8|same:confirm_new_password',
            'confirm_new_password' => 'required|string',
        ]);
        if($validate) {
            if(Hash::check($request->old_password, Auth::user()->password)) {
                User::where('id', Auth::user()->id)->update(['password' => Hash::make($request->new_password)]);
                return redirect('profil/ubah-password')->with('success', 'Password berhasil diubah');
            } else {
                return redirect('profil/ubah-password')->with('error', 'Password gagal diubah');
            }
        }
    }

    public function history() {
         $data = ScheduleDetail::join('books','books.schedule_detail_id','=','schedule_details.id')
                ->join('schedules','schedules.id','=','schedule_details.schedule_id')
                ->join('employees','employees.id','=','schedule_details.employee_id')
                ->join('products','products.id','=','books.product_id')
                ->join('users','users.id','=','books.user_id')
                ->select('books.id as book_id', 'products.name as product_name', 'products.price as product_price', 'products.image as product_image', 'books.invoice', 'employees.name as employee_name', 'schedules.day as schedule_day', 'schedules.date as schedule_date','schedule_details.time_start', 'schedule_details.time_end', 'books.created_at as books_created_at','users.name as user_name', 'books.status as book_status', 'is_promo')
                ->where('books.user_id', Auth::user()->id)
                ->get();
        return view('frontend.profile.index', compact([
            'data'
        ]));
    }

    public function historyAction($id) {
        $data = ScheduleDetail::join('books','books.schedule_detail_id','=','schedule_details.id')->where('books.id',$id)->first();
        ScheduleDetail::where('id', $data->schedule_detail_id)->update(['status' => 3]);
        Book::where('id',$id)->update(['status' => 2]);
        $user = User::where('id', Auth::user()->id);
        return redirect('profil/history-booking')->with('success', 'Status booking berhasil diubah');
    }
}
