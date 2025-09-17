<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sugerencia extends Model
{
    protected $fillable = [
        'nombre',
        'email',
        'mensaje',
    ];
}