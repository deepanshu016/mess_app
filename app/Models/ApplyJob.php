<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;

class ApplyJob extends Model implements HasMedia
{
    use HasFactory,InteractsWithMedia;
    protected $table = "job_applications";
    protected $appends = ['medias'];
    protected $fillable = [
        'name',
        'email',
        'phone',
        'job_id',
        'about',
    ];


    protected function getMediasAttribute()
    {
        $media = $this->getMedia("JOB_ATTACHEMENT")->first();
        if ($media) {
            return asset('public/media/') . '/' . $media->id . '/' . $media->file_name;
        }
        return null;
    }
}
