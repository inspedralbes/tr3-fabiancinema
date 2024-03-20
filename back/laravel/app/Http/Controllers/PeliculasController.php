<?php

namespace App\Http\Controllers;

use App\Models\Pelicula;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PeliculasController extends Controller
{
    public function index()
    {
        $peliculas = Pelicula::inRandomOrder()->take(5)->get();
        return response()->json($peliculas);
    }
    
    public function show($id_pelicula)
{   
    $pelicula = Pelicula::all()->where('id_pelicula', $id_pelicula)->first();
    if (!$pelicula) {
        return response()->json(['error' => 'Pelicula no encontrada'], 404);
    }
    return response()->json($pelicula);
}

}