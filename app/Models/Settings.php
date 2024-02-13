<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;

class Settings extends Model implements HasMedia
{
    use HasFactory,InteractsWithMedia;
    protected $table = "site_settings";
    protected $fillable = [
        'title',
        'description',
        'meta_title',
        'meta_description',
        'mobile_no',
        'email',
        'address',
        'gst',
        'about_us',
        'terms_condition',
        'privacy_policy',
        'return_refund',
        'analytics_code'
    ];

}
