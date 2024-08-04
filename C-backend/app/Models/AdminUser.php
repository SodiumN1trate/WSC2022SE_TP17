<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class AdminUser extends Authenticatable
{
    use HasFactory, HasApiTokens;


    protected $fillable = [
        'username',
        'password',
        'last_login_at',
    ];


    protected $casts = [
        'password' => 'hashed',
    ];
}
