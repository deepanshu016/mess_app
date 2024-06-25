<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    protected $table = "faqs";
    protected $fillable = [
        'question',
        'answer',
        'status'
    ];
    protected function question(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => htmlentities($value, ENT_QUOTES, 'UTF-8'),
        );
    }
    protected function answer(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => html_entity_decode($value),
            set: fn (string $value) => htmlentities($value, ENT_QUOTES, 'UTF-8'),
        );
    }
}
