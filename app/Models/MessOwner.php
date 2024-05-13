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
    protected $appends = ['logo','banner'];
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
        'non_veg_dinner_price',
        'country_id',
        'state_id',
        'city_id',
        'address',
        'pincode',
        'address_link',
        'account_details',
        'is_delivery_boy_available'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function cuisines()
    {
        return $this->hasMany(MessCuisine::class,'mess_id','id');
    }
    protected function getLogoAttribute()
    {
        $media = $this->getMedia("MESS_LOGO_IMAGE")->first();
        if ($media) {
            return asset('public/media/') . '/' . $media->id . '/' . $media->file_name;
        }
        return null;
    }
    protected function getBannerAttribute()
    {
        $media = $this->getMedia("MESS_BANNER")->first();
        if ($media) {
            return asset('public/media/') . '/' . $media->id . '/' . $media->file_name;
        }
        return null;
    }
    public function country()
    {
        return $this->belongsTo(Country::class);
    }
    public function state()
    {
        return $this->belongsTo(State::class);
    }
    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
