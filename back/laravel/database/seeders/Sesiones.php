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
        $peliculas = Pelicula::pluck('id_pelicula')->toArray();
        shuffle($peliculas);

        if (empty($peliculas)) {
            $this->command->info('No hay películas disponibles en la base de datos.');
            return;
        }

        $diaEspectador = Carbon::now()->addDays(0);
        $horasPermitidas = ['16:00', '18:00', '20:00'];

        foreach ($peliculas as $peliculaId) {
            if (empty($peliculaId)) {
                continue;
            }

            $horaSesionNormal = Carbon::createFromTime(16, 0);

            $horaAleatoria = $horasPermitidas[array_rand($horasPermitidas)];

            list($hour, $minute) = explode(':', $horaAleatoria);

            $horaSesionNormal->hour = $hour;
            $horaSesionNormal->minute = $minute;

            if (empty($peliculaId)) {
                break;
            }

            $diaSesionNormal = Carbon::now()->addDays(1);

            Sesion::create([
                'id_pelicula' => $peliculaId,
                'dia' => $diaSesionNormal,
                'hora' => $horaSesionNormal->format('H:i'),
                'dia_espectador' => $diaSesionNormal->dayOfWeek === $diaEspectador->dayOfWeek ? 1 : 0,
            ]);
        }
    }
}
