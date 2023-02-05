<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $table = 'books';
    protected $fillable = [
        'schedule_detail_id',
        'user_id',
        'product_id',
        'invoice',
        'status',
        'is_promo',
        'transfer_date',
        'account_number',
        'to_bank',
        'on_behalf_of',
        'total_transfers',
        'remaining_payment',
        'evidence_of_transfer',
        'payment_status',
        'rate_status'
    ];
}
