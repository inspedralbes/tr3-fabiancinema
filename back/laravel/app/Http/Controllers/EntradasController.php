<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Entrada;

class EntradasController extends Controller
{
    public function index()
    {
        $entradas = Entrada::all();
        return response()->json($entradas);
    }

    public function show($id_entrada)
    {
        $entradas = Entrada::all()->where('id_entrada', $id_entrada)->first();
        if (!$entradas) {
            return response()->json(['error' => 'Entrada no encontrada'], 404);
        }
        return response()->json($entradas);
    }

    public function store(Request $request) {
        $data = $request->validate([
            'id_sesion' => 'required|exists:sesion,id_sesion',
            'fila' => 'required|integer',
            'columna' => 'required|integer',
            'precio' => 'required|numeric',
        ]);
        
        $entrada = Entrada::create($data);

        return response()->json($entrada, 201);
    }
}

// {
//     "id_sesion": 1,
//     "fila": 3,
//     "columna": 8,
//     "precio": 6
//   }
  
  
//   [
//       {
//           "columna": 4,
//           "fila": 5,
//           "ocupado": true,
//           "vip": false
//       },
//       {
//           "columna": 5,
//           "fila": 5,
//           "ocupado": true,
//           "vip": false
//       },
//       {
//           "columna": 6,
//           "fila": 5,
//           "ocupado": true,
//           "vip": false
//       }
//   ]