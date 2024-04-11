<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::create('peliculas', function (Blueprint $table) {
        $table->id('id_pelicula')->autoIncrement();
        $table->string('titulo');
        $table->string('director');
        $table->string('genero');
        $table->integer('duracion');
        $table->year('fecha')->default(date('Y'));
        $table->string('portada')->default('https://img.freepik.com/vector-premium/icono-carga-porcentaje-carga-descarga-progreso-carga-ilustracion-vectorial_266660-667.jpg');
        $table->timestamps();
    });
}


    public function down(): void
    {
        Schema::dropIfExists('peliculas');
    }
};
