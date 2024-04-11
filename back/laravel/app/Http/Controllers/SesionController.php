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
}
