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
        'veg_breakfast_price',
        'veg_lunch_price',
        'veg_dinner_price',
        'non_veg_breakfast_price',
        'non_veg_lunch_price',
        'non_veg_dinner_price'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
