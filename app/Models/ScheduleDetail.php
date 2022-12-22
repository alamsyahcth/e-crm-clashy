<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScheduleDetail extends Model
{
    use HasFactory;
    protected $table = 'schedule_details';
    protected $fillable = [
        'schedule_id',
        'employee_id',
        'time_start',
        'time_end',
        'status',
    ];
}
