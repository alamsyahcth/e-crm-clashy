<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discussion extends Model
{
    use HasFactory;
    protected $table = 'discussions';
    protected $fillable = [
        'product_id',
        'user_id',
        'message'
    ];
}
