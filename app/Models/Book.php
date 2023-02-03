<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    public const STATUSES = [
        'Available' => 'Tersedia',
        'Unavailable' => 'Tidak tersedia',
    ];

    protected $fillable = [
        'title',
        'synopsis',
        'publisher',
        'writer',
        'publish_year',
        'cover',
        'category',
        'amount',
        'status',
    ];

    public function borrows()
    {
        return $this->hasMany(Borrow::class);
    }
}
