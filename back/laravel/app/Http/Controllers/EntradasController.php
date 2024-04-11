<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Entrada;
use Illuminate\Support\Facades\Validator;
use App\Mail\CompraEntradasConfirmation;
use Illuminate\Support\Facades\Mail;

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
                'correo' => 'required',
            ]);
    
            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }
        }
    
        $entradas = [];
    
        for ($i=0; $i < count($data); $i++) { 
            $entrada = Entrada::create([
                'id_sesion' => $data[$i]['id_sesion'],
                'fila' => $data[$i]['fila'],
                'columna' => $data[$i]['columna'],
                'precio' => $data[$i]['precio'],
                'correo' => $data[$i]['correo'],
            ]);
    
            $entradas[] = $entrada;
        }

        Mail::to($data[0]['correo'])->send(new CompraEntradasConfirmation($entradas));
    
        return response()->json($entradas, 200);
    }
    
}
