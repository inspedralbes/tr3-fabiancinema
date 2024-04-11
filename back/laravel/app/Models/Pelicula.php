<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelicula extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_pelicula';

    protected $fillable = [
        'titulo',
        'director',
        'genero',
        'duracion',
        'fecha',
        'portada',
    ];

    // Relación con las sesiones
    public function sesiones()
    {
        return $this->hasMany(Sesion::class, 'id_pelicula', 'id_pelicula');
    }
}
