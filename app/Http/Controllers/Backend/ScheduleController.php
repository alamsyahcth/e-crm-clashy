<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Schedule;
use App\Models\ScheduleDetail;
use App\Models\Employee;
use App\Models\Book;
use App\Models\User;
use DB;
use Carbon\Carbon;

class ScheduleController extends Controller
{
    protected $type = 'backend';
    protected $role = 'admin';
    protected $page = 'Jadwal';
    protected $path = 'schedule';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Schedule::get();
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
        $employee = Employee::where('status', 1)->get();
        $role = $this->role;
        $page = $this->page;
        $path = $this->path;
        return view($this->type.'.'.$this->path.'.create', compact(['role', 'page', 'path', 'employee']));
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
            'date' => 'required|unique:schedules'
        ]);
        if($validation) {
            $day = $this->handleDay(Carbon::parse($request->date)->format('l'));
            DB::beginTransaction();
            try{
                $data = New Schedule;
                $data->day = $day;
                $data->date = $request->date;
                $data->status = 1;
                $data->save();
                foreach($request->dataUser as $d => $value) {
                    foreach($request->input('time-'.$d) as $t => $timeValue) {
                        $dataSchedule = new ScheduleDetail;
                        $dataSchedule->schedule_id = $data->id;
                        $dataSchedule->employee_id = $request->dataUser[$d];
                        $dataSchedule->time_start = $this->timeAction($request->input('time-'.$d)[$t], 1);
                        $dataSchedule->time_end =  $this->timeAction($request->input('time-'.$d)[$t], 2);
                        $dataSchedule->status = 0;
                        $dataSchedule->save();
                    }
                }
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
     * @param  string  $day
     * @return \Illuminate\Http\Response
     */
    public function handleDay($day)
    {
        switch($day) {
            case 'Monday':
                return 'Senin';

            case 'Tuesday':
                return 'Selasa';

            case 'Wednesday':
                return 'Rabu';

            case 'Thursday':
                return 'Kamis';

            case 'Friday':
                return 'Jumat';

            case 'Saturday':
                return 'Sabtu';

            case 'Sunday':
                return 'Minggu';
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  string  $time
     * @param int $type
     * @return \Illuminate\Http\Response
     */
    protected function timeAction($time, $type) {
        if($type == 1) {
            if(strlen($time) == 1) {
                $timeData = sprintf("%02d", $time);
            } else {
                $timeData = $time;
            }
            return $timeData.':'.'00'.':'.'00';
        } else if($type == 2) {
            $time = (int)$time+1;
            if(strlen($time) == 1) {
                $timeData = sprintf("%02d", $time);
            } else {
                $timeData = $time;
            }
            return $timeData.':'.'00'.':'.'00';
        } else {
            return false;
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
        $schedule = Schedule::find($id);
        $scheduleDetails = ScheduleDetail::where('schedule_id',$id)->get();
        $employee = Employee::get();
        $user = Book::join('schedule_details','schedule_details.id', '=', 'books.schedule_detail_id')
                ->join('users','users.id','=','books.user_id')
                ->select('*','books.id as book_id');
        $getUser = $user->get();
        $role = $this->role;
        $page = $this->page;
        $path = $this->path;
        return view($this->type.'.'.$this->path.'.show', compact(['role', 'page', 'path', 'schedule','scheduleDetails','employee','getUser']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deactive($id)
    {
        $data = Schedule::where('id', $id)->update(['status' => 0]);
        notify()->success('Berhasil Menambahkan Data');
        return redirect($this->role.'/'.str_replace(' ', '-', strtolower($this->page)));
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
