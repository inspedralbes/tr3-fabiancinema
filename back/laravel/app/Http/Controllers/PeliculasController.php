<?php

namespace App\Http\Controllers;

use App\Models\Pelicula;
use App\Models\Sesion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PeliculasController extends Controller
{
    public function index()
    {
        $peliculas = Pelicula::all();
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

    public function store(Request $request)
{
    $pelicula = new Pelicula();
    $pelicula->titulo = $request->titulo;
    $pelicula->director = $request->director;
    $pelicula->genero = $request->genero;
    $pelicula->duracion = $request->duracion;
    $pelicula->fecha = date('Y');
    $pelicula->save();

    return response()->json($pelicula, 200);
}

    public function update(Request $request, $id_pelicula)
    {
        $pelicula = Pelicula::find($id_pelicula);
        if (!$pelicula) {
            return response()->json(['error' => 'Pelicula no encontrada'], 404);
        }
        $pelicula->update($request->all());
        return response()->json($pelicula, 200);
    }

    public function destroy(Request $request, $id_pelicula)
    {
        // Buscar la película en la base de datos
        $pelicula = Pelicula::where('id_pelicula', $id_pelicula)->first();

        // Si la película no existe, devolver una respuesta de error
        if (!$pelicula) {
            return response()->json(['message' => 'Pelicula no encontrada'], 404);
        }

        // Eliminar las sesiones relacionadas
        DB::table('sesion')->where('id_pelicula', $id_pelicula)->delete();

        // Eliminar la película de la base de datos
        $pelicula->delete();

        // Devolver una respuesta de éxito
        return response()->json(['message' => 'Pelicula eliminada con éxito']);
    }

    

}
