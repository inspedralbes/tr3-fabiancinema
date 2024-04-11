<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PeliculasController;
use App\Http\Controllers\SesionController; // Importa el controlador de sesiones
use App\Http\Controllers\EntradasController;
use Illuminate\Support\Facades\DB;

// Rutas para películas
Route::get('/peliculas', [PeliculasController::class, 'index']);
Route::get('/peliculas/{id_pelicula}', [PeliculasController::class, 'show']);
Route::post('/peliculas', [PeliculasController::class, 'store']);
Route::put('/peliculas/{id}', [PeliculasController::class, 'update']);
Route::delete('/peliculas/{id}', [PeliculasController::class, 'destroy']);

// Rutas para sesiones
Route::get('/sesiones', [SesionController::class, 'index']); // Listar todas las sesiones
Route::get('/sesiones/{id_sesion}', [SesionController::class, 'show']); // Mostrar una sesión por su ID
Route::post('/sesiones', [SesionController::class, 'store']); // Crear una nueva sesión
Route::put('/sesiones/{id_sesion}', [SesionController::class, 'update']); // Actualizar una sesión existente
Route::delete('/sesiones/{id_sesion}', [SesionController::class, 'destroy']); // Eliminar una sesión

// Otras rutas
Route::get('/entradas', [EntradasController::class, 'index']);
Route::post('/entradas', [EntradasController::class, 'store']);

Route::middleware('auth:sanctum')->group(function () {
    // Rutas protegidas por autenticación
});
