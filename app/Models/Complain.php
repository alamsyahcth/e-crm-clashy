<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complain extends Model
{
    use HasFactory;
    protected $table = 'complains';
    protected $fillable = [
        'product_id',
        'user_id',
        'is_admin',
        'is_customer',
        'message',
    ];
}
