<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
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
        'amount',
        'payment_mode',
        'notes',
        'status'
    ];
    protected $appends = ['medias'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function mess_owner()
    {
        return $this->belongsTo(MessOwner::class,'mess_id');
    }
    protected function getMediasAttribute()
    {
        $media = $this->getMedia("PAYMENT_SCREENSHOT")->first();

        if ($media) {
            return asset('public/media/') . '/' . $media->id . '/' . $media->file_name;
        }
        return null;
    }
}
