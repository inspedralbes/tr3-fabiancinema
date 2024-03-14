<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pelicula;
use App\Models\Sesion;
use Carbon\Carbon;

class Sesiones extends Seeder
{
    public function run()
    {
        $peliculas = Pelicula::pluck('id_pelicula');

        if ($peliculas->isEmpty()) {
            $this->command->info('No hay películas disponibles en la base de datos.');
            return;
        }

        $fechaActual = Carbon::now();
        $diaEspectador = 3;

        $horaSesionDiaEspectador = Carbon::createFromTime(14, 0);
        Sesion::create([
            'id_pelicula' => $peliculas->random(),
            'dia' => $diaEspectador,
            'hora' => $horaSesionDiaEspectador->format('H:i:s'),
            'dia_espectador' => 1,
        ]);

        for ($i = 0; $i < 5; $i++) {
            if ($i + 1 === $diaEspectador) {
                continue;
            }

            $horaSesionNormal = Carbon::createFromTime(14, 0);
            Sesion::create([
                'id_pelicula' => $peliculas->random(),
                'dia' => $i + 1,
                'hora' => $horaSesionNormal->format('H:i:s'),
                'dia_espectador' => 0,
            ]);
        }
    }
}
