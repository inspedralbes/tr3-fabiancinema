<?php

namespace App\Http\Controllers;

use App\Models\Pelicula;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PeliculasController extends Controller
{
    public function index()
    {
        $peliculas = Pelicula::all();
        return response()->json($peliculas);
    }
    
    public function show($id)
    {
        $pelicula = Pelicula::find($id);
        if (!$pelicula) {
            return response()->json(['error' => 'Pelicula no encontrada'], 404);
        }
        return response()->json($pelicula);
    }
}