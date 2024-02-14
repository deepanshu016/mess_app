<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
class MessOwner extends Model implements HasMedia
{
    use HasFactory,InteractsWithMedia;
    protected $table = "mess_owner";
    protected $fillable = [
        'user_id',
        'mess_name',
        'mess_description',
        'food_type',
        'veg_price',
        'non_veg_price'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
