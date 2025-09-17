<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barbero extends Model
{
    use HasFactory;

    protected $table = 'barberos';

    protected $fillable = [
        'nombre',
        'especialidad',
        'horario',
    ];

    
    public function citas()
    {
        return $this->hasMany(Cita::class, 'barbero_id');
    }
}
