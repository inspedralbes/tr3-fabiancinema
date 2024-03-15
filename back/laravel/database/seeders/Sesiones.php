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
        shuffle($peliculas); // Mezclar aleatoriamente las películas

        if (empty($peliculas)) {
            $this->command->info('No hay películas disponibles en la base de datos.');
            return;
        }

        $diaEspectador = Carbon::now()->addDays(0); // Añadir 3 días a partir de hoy para el día del espectador

        $horaSesionDiaEspectador = Carbon::createFromTime(16, 0);
        Sesion::create([
            'id_pelicula' => array_shift($peliculas),
            'dia' => $diaEspectador, // Utiliza Carbon para la fecha del día del espectador
            'hora' => $horaSesionDiaEspectador->format('H:i'),
            'dia_espectador' => 1,
        ]);

        $horasPermitidas = ['16:00', '18:00', '20:00'];

        for ($i = 0; $i < 5; $i++) {
            if ($i + 1 === $diaEspectador->dayOfWeek) {
                continue;
            }

            $horaSesionNormal = Carbon::createFromTime(16, 0);

            $horaAleatoria = $horasPermitidas[array_rand($horasPermitidas)];

            list($hour, $minute) = explode(':', $horaAleatoria);

            $horaSesionNormal->hour = $hour;
            $horaSesionNormal->minute = $minute;

            if (empty($peliculas)) {
                break;
            }

            $diaSesionNormal = Carbon::now()->addDays($i + 1); // Añadir días a partir de hoy para la fecha de la sesión normal

            Sesion::create([
                'id_pelicula' => array_shift($peliculas),
                'dia' => $diaSesionNormal, // Utiliza Carbon para la fecha de la sesión normal
                'hora' => $horaSesionNormal->format('H:i'),
                'dia_espectador' => 0,
            ]);
        }
    }
}
