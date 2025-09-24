<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Usuario extends Authenticatable
{
    use Notifiable;

    protected $table = 'usuarios';

    protected $fillable = [
        'username',
        'email',
        'password',
        'telefono',
        'rol',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Relación con las citas del usuario (como cliente)
    public function citas()
    {
        return $this->hasMany(Cita::class, 'usuario_id');
    }

    // Relación con las citas donde es el barbero
    public function citasComoBarbero()
    {
        return $this->hasMany(Cita::class, 'barbero_id');
    }

    // Accesor para el nombre (usando username)
    public function getNameAttribute()
    {
        return $this->username;
    }
}