<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barbero extends Model
{
    use HasFactory;

    protected $table = 'barberos';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'nombre',
        'especialidad',
        'horario'
    ];

    // 🔹 Un barbero puede tener muchas citas
    public function citas()
    {
        return $this->hasMany(Cita::class, 'barbero_id');
    }
}
