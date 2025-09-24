<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sugerencia extends Model
{
    protected $fillable = [
        'usuario_id',
        'mensaje',
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id', 'id'); 
    }
}


