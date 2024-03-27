<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplyJob extends Model
{
    use HasFactory;
    protected $table = "job_applications";
    protected $fillable = [
        'name',
        'email',
        'phone',
        'job_id',
        'about',
    ];
}
