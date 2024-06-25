<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model implements HasMedia
{
    use HasFactory,InteractsWithMedia;
    protected $table = "blogs";
    protected $appends = ['medias'];
    protected $fillable = [
        'title',
        'description',
        'status'
    ];
    protected function title(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => htmlentities($value, ENT_QUOTES, 'UTF-8'),
        );
    }
    protected function getMediasAttribute()
    {
        $media = $this->getMedia("BLOG_IMAGE")->first();
        if ($media) {
            return asset('public/media/') . '/' . $media->id . '/' . $media->file_name;
        }
        return null;
    }
}

