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
        'usuario_id',
        'barbero_id',
        'fecha_hora',
        'servicio',
        'estado',
        'email',
    ];

    // Relación con el cliente (usuario normal)
    public function cliente()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }

    // Relación con el barbero (usuario con rol barbero)
    public function barbero()
    {
        return $this->belongsTo(Usuario::class, 'barbero_id');
    }
}


