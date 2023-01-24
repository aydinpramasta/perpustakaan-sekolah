<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public const NUMBER_TYPES = [
        'NIS',
        'NIP',
        'NIK',
    ];

    protected $fillable = [
        'name',
        'number',
        'number_type',
        'role',
        'password',
        'address',
        'telephone',
        'gender',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
