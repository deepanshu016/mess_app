<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MessCuisine extends Model
{
    use HasFactory;
    protected $table = 'mess_cuisines';

    protected $fillable = [
        'mess_id',
        'cuisine_id'
    ];


    public function mess()
    {
        return $this->belongsTo(MessOwner::class,'mess_id');
    }
    public function cuisine()
    {
        return $this->belongsTo(Cuisine::class,'cuisine_id');
    }
}
