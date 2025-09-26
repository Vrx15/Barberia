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

     protected $casts = [
        'fecha_hora' => 'datetime',
    ];


    // Relación con el cliente (usuario normal)
    public function cliente()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }

    // Relación con el barbero
    public function barbero()
    {
        return $this->belongsTo(Usuario::class, 'barbero_id');
    }

    // Accesor para la fecha formateada
    public function getFechaFormateadaAttribute()
    {
         return $this->fecha_hora ? $this->fecha_hora->format('d/m/Y') : 'No definida';
    }

    // Accesor para la hora formateada
    public function getHoraFormateadaAttribute()
    {
        return $this->fecha_hora ? $this->fecha_hora->format('H:i') : 'No definida';
    }

    // Accesor para fecha y hora completa
    public function getFechaHoraCompletaAttribute()
    {
         return $this->fecha_hora ? $this->fecha_hora->format('d/m/Y H:i') : 'No definida';
    }
}