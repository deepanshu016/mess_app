<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarkDay extends Model
{
    use HasFactory;
    protected $table = "mark_days";
    protected $fillable = [
        'user_id',
        'mess_id',
        'mark_date'
    ];
}
