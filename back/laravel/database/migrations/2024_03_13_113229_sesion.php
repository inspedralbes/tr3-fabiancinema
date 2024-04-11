<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sesion', function (Blueprint $table) {
            $table->id('id_sesion')->autoIncrement();
            $table->unsignedBigInteger('id_pelicula');
            $table->date('dia');
            $table->time('hora');
            $table->integer('dia_espectador')->default(0);
            $table->timestamps();
        
            $table->foreign('id_pelicula')->references('id_pelicula')->on('peliculas');
        });        
    }

    public function down(): void
    {
        Schema::dropIfExists('sesion');
    }
};
