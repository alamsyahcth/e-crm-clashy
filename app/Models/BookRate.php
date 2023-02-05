<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookRate extends Model
{
    use HasFactory;

    protected $table = 'book_rates';
    protected $fillable = [
        'book_id',
        'rate',
    ];
}
