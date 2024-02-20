<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;

class Complain extends Model implements HasMedia
{
    use HasFactory,InteractsWithMedia;
    protected $table = "complains";
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function mess_owner()
    {
        return $this->belongsTo(MessOwner::class);
    }
}
