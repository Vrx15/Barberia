<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    use HasFactory;

    protected $table = 'citas';
    protected $primaryKey = 'id_cita';

    protected $fillable = [
        'nombre_cliente_cita',
        'fecha',
        'hora',
        'barbero_id',
        'estado',
    ];

    
    public function barbero()
    {
        return $this->belongsTo(Barbero::class, 'barbero_id');
    }
}

