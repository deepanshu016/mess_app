<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Menu extends Model implements HasMedia
{
    use HasFactory,InteractsWithMedia;
    protected $appends = ['count'];
    protected $fillable = [
        'added_by',
        'day',
        'menu_type',
        'mess_detail_breakfast',
        'mess_detail_lunch',
        'mess_detail_dinner',
    ];
    protected function menuType(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => strtoupper($value),
        );
    }
    protected function getCountAttribute()
    {

        $returnable = 0;
        if($this->mess_detail_breakfast){
            $returnable += 1;
        }
        if($this->mess_detail_lunch){
            $returnable += 1;
        }
        if($this->mess_detail_dinner){
            $returnable += 1;
        }
        return $returnable;
    }
}
