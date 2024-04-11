<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sesion extends Model
{
    use HasFactory;

    protected $table = 'sesion';

    protected $fillable = [
        'id_pelicula',
        'dia',
        'hora',
        'dia_espectador',
    ];

    protected $primaryKey = 'id_sesion';

    public function pelicula()
    {
        return $this->belongsTo(Pelicula::class, 'id_pelicula');
    }
}
