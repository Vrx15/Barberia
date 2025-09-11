<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    use HasFactory;

    protected $table = 'citas';
    protected $primaryKey = 'id_cita';
    public $timestamps = true;

    protected $fillable = [
    'nombre_cliente_cita',
    'servicio',
    'fecha',
    'hora',
    'barbero_id',
    'usuario_id',
    'estado'
];

    // 🔹 Una cita pertenece a un barbero
    public function barbero()
    {
        return $this->belongsTo(Barbero::class, 'barbero_id');
    }
}