<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restore extends Model
{
    use HasFactory;

    protected $table = "returns";
    
    public $timestamps = false;

    public const STATUSES = [
        'Returned' => 'Telah dikembalikan',
        'Not confirmed' => 'Belum dikonfirmasi',
        'Past due' => 'Terlambat',
        'Fine not paid' => 'Belum membayar denda',
    ];

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

    public function book() {
        return $this->belongsTo(Book::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function borrow() {
        return $this->belongsTo(Borrow::class);
    }
}
