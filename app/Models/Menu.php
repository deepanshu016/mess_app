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
    protected $fillable = [
        'added_by',
        'day',
        'menu_type',
        'mess_detail_breakfast',
        'mess_detail_lunch',
        'mess_detail_dinner',
    ];
    // protected function menuType(): Attribute
    // {
    //     return Attribute::make(
    //         get: fn (string $value) => strtoupper($value),
    //     );
    // }
    // protected function day(): Attribute
    // {
    //     return Attribute::make(
    //         get: fn (string $value) => strtoupper($value),
    //     );
    // }
    // public function mess_owner(): HasOne
    // {
    //     return $this->hasOne(MessOwner::class);
    // }
}