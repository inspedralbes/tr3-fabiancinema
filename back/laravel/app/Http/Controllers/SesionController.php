<?php

namespace App\Http\Controllers;

use App\Models\Sesion;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SesionController extends Controller
{
    public function index() {
        $sesiones = Sesion::all();
        return response()->json($sesiones);
    }

    public function show($id_sesion) {
        $sesion = Sesion::find($id_sesion);
        if (!$sesion) {
            return response()->json(['error' => 'Sesion no encontrada'], 404);
        }
        return response()->json($sesion);
    }

    public function store(Request $request) {
        $sesion = new Sesion();
        $sesion->id_pelicula = $request->id_pelicula;
        $sesion->dia = $request->dia;
        $sesion->hora = $request->hora;
        $sesion->dia_espectador = $request->dia_espectador;
        $sesion->save();

        return response()->json($sesion, 200);
    }

    public function update(Request $request, $id_sesion) {
        $sesion = Sesion::find($id_sesion);
        if (!$sesion) {
            return response()->json(['error' => 'Sesion no encontrada'], 404);
        }
        $sesion->update($request->all());
        return response()->json($sesion, 200);
    }

    public function destroy(Request $request, $id_sesion) {
        $sesion = Sesion::where('id_sesion', $id_sesion)->first();
        if (!$sesion) {
            return response()->json(['message' => 'Sesion no encontrada'], 404);
        }
        $sesion->delete();
        return response()->json(['message' => 'Sesion eliminada'], 200);
    }
}
