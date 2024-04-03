<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PeliculasController;
use App\Http\Controllers\SesionesController;
use App\Http\Controllers\EntradasController;
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
Route::get('/sesiones/{id_sesion}', function ($id_sesion) {
    $sesion = DB::table('sesion')
        ->join('peliculas', 'sesion.id_pelicula', '=', 'peliculas.id_pelicula') 
        ->select('sesion.*', 'peliculas.titulo')
        ->where('id_sesion', $id_sesion)
        ->first();
    if (!$sesion) {
        return response()->json(['error' => 'Sesion no encontrada'], 404);
    }
    return response()->json($sesion);
});

Route::get('/entradas', [EntradasController::class, 'index']);

Route::post('/entradas', [EntradasController::class, 'store']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
