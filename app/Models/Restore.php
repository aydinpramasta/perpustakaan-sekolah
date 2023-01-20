<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restore extends Model
{
    use HasFactory;

    protected $table = "returns";
    
    public $timestamps = false;

    protected $fillable = [
        'returned_at',
        'fine',
        'status',
        'confirmation',
        'book_id',
        'user_id',
        'borrow_id',
    ];

    protected $casts = [
        'returned_at' => 'datetime',
    ];
}
