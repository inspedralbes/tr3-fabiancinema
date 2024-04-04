<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Entrada;
use Illuminate\Support\Facades\Validator;

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
        $data = $request->json()->all();

        for ($i=0; $i < count($data); $i++) { 
             $validator = Validator::make($data[$i], [
                'id_sesion' => 'required|exists:sesion,id_sesion',
                'fila' => 'required|integer',
                'columna' => 'required|integer',
                'precio' => 'required|numeric',
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }
        }

        for ($i=0; $i < count($data); $i++) { 
            $entrada = Entrada::create($data[$i]);
        }

        return response()->json($entrada, 200);
    }
}