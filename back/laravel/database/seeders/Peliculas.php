<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class Peliculas extends Seeder
{
    public function run(): void
    {
        $filePath = public_path('peliculas.json');

        if (File::exists($filePath)) {
            $data = json_decode(File::get($filePath), true);

            foreach ($data['peliculas'] as $item) {
                DB::table('peliculas')->insert([
                    'titulo' => $item['titulo'],
                    'director' => $item['director'],
                    'genero' => $item['genero'],
                    'duracion' => $item['duracion'],
                    'fecha' => $item['fecha'],
                    'portada' => $item['portada'],
                ]);
            }            
        } else {
            echo "El archivo peliculas.json no existe en la carpeta public.";
        }
    }
}
