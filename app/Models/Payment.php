<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
class Payment extends Model implements HasMedia
{
    use HasFactory,InteractsWithMedia;
    protected $table = "payments";
    protected $fillable = [
        'user_id',
        'mess_id',
        'payment_date',
        'expiry'
    ];
}
