<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $table = 'productos';
    protected $primaryKey = 'id_producto';

    protected $fillable = [
        'precio',
        'cantidad',
        'categoria',
        'nombre',
    ];
    public function getRouteKeyName()
{
    return 'id_producto';
}
}
