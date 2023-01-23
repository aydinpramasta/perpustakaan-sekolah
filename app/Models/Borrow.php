<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Borrow extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'borrowed_at',
        'duration',
        'amount',
        'confirmation',
        'book_id',
        'user_id',
    ];

    protected $casts = [
        'borrowed_at' => 'datetime',
    ];
}