<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $table = 'productos';
    protected $primaryKey = 'id_producto';
    public $timestamps = true;

    protected $fillable = [
        'precio',
        'cantidad',
        'categoria',
        'nombre'
    ];

    // 🔹 Por ahora no hay relación directa con otros modelos
}

