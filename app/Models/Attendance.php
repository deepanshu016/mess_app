<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;
    protected $table = "attendances";
    protected $fillable = [
        'user_id',
        'mess_id',
        'date',
        'breakfast',
        'lunch',
        'dinner'
    ];
}
