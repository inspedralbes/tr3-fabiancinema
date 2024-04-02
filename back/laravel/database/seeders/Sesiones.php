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
        // Obtener todas las películas
        $peliculas = Pelicula::all();

        if ($peliculas->isEmpty()) {
            $this->command->info('No hay películas disponibles en la base de datos.');
            return;
        }

        // Obtener el día actual
        $diaActual = Carbon::now();

        // Obtener las horas permitidas para las sesiones
        $horasPermitidas = ['16:00', '18:00', '20:00'];

        // Iterar sobre las películas
        foreach ($peliculas as $pelicula) {
            // Inicializar el día de la sesión
            $diaSesion = $diaActual->copy();

            // Verificar si ya hay una sesión programada para este día
            while (Sesion::whereDate('dia', $diaSesion)->exists()) {
                // Si ya hay una sesión programada para este día, avanzamos al siguiente día
                $diaSesion->addDay();
            }

            // Elegir una hora aleatoria entre las horas permitidas
            $horaAleatoria = $horasPermitidas[array_rand($horasPermitidas)];
            $horaSesion = Carbon::createFromFormat('H:i', $horaAleatoria);

            // Crear la sesión
            Sesion::create([
                'id_pelicula' => $pelicula->id_pelicula,
                'dia' => $diaSesion,
                'hora' => $horaSesion->format('H:i'),
                'dia_espectador' => $diaSesion->dayOfWeek === Carbon::TUESDAY ? 1 : 0,
            ]);
        }
    }
}
