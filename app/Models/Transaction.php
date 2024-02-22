<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $table = "transactions";
    protected $fillable = [
        'user_id',
        'mess_id',
        'transaction_type',
        'transaction_tag',
        'transaction_date',
        'amount',
        'balance'
    ];
}
