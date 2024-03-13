<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sesion', function (Blueprint $table) {
            $table->id('id_sesion')->autoIncrement;
            $table->unsignedBigInteger('id_pelicula');
            $table->integer('dia');
            $table->time('hora');
            $table->boolean('diaEspectador');
            $table->timestamps();

            $table->foreign('id_pelicula')->references('id_pelicula')->on('peliculas');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sesion');
    }
};
