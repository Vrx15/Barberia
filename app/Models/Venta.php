<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;

    protected $table = 'ventas';
    protected $primaryKey = 'id_venta';

    protected $fillable = [
        'producto_id',
        'barbero_id',
        'cantidad',
        'total',
    ];

    // Relaciones
    public function producto()
    {
        return $this->belongsTo(Producto::class, 'producto_id', 'id_producto');
    }

    public function barbero()
    {
        return $this->belongsTo(Usuario::class, 'barbero_id', 'id');
    }

    public function getRouteKeyName()
    {
        return 'id_venta';
    }
}

