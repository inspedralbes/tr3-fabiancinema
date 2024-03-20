<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PeliculasController;
use App\Http\Controllers\SesionesController;
use Illuminate\Support\Facades\DB;

Route::get('/peliculas', [PeliculasController::class, 'index']);
Route::get('/peliculas/{id_pelicula}', [PeliculasController::class, 'show']);


Route::get('/sesiones', function () {
    $sesiones = DB::table('sesion')
        ->join('peliculas', 'sesion.id_pelicula', '=', 'peliculas.id_pelicula') 
        ->select('sesion.*', 'peliculas.titulo')
        ->get();
    return response()->json($sesiones);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
