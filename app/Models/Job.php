<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'vacant_seat',
        'description'
    ];

    public function applications()
    {
        return $this->hasMany(ApplyJob::class);
    }



}
