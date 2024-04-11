<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('entradas', function (Blueprint $table) {
            $table->id('id_entrada')->autoIncrement();
            $table->unsignedBigInteger('id_sesion');
            $table->integer('fila');
            $table->integer('columna');
            $table->integer('precio');
            $table->string('correo');
            $table->timestamps();

            $table->foreign('id_sesion')->references('id_sesion')->on('sesion');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('entradas');
    }
};
