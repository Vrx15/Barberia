<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable; // <- importante
use Illuminate\Notifications\Notifiable;

class Usuario extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'username',
        'email',
        'telefono',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}


