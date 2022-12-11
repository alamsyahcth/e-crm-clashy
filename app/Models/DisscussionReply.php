<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DisscussionReply extends Model
{
    use HasFactory;
    protected $table = 'disscussion_replies';
    protected $fillable = [
        'discussion_id',
        'message'
    ];
}
