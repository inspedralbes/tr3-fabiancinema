<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Entrada;
use Illuminate\Support\Facades\Validator;
use App\Mail\CompraEntradasConfirmation;
use App\Models\Pelicula;
use App\Models\Sesion;
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
        $entrada = Entrada::findOrFail($id_entrada);
        return response()->json($entrada);
    }

    public function store(Request $request)
    {
        $data = $request->json()->all();

        for ($i = 0; $i < count($data); $i++) {
            $validator = Validator::make($data[$i], [
                'id_sesion' => 'required|exists:sesion,id_sesion',
                'fila' => 'required|integer',
                'columna' => 'required|integer',
                'precio' => 'required|numeric',
                'correo' => 'required|email',
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }
        }

        $entradas = [];

        foreach ($data as $entradaData) {
            $entrada = Entrada::create([
                'id_sesion' => $entradaData['id_sesion'],
                'fila' => $entradaData['fila'],
                'columna' => $entradaData['columna'],
                'precio' => $entradaData['precio'],
                'correo' => $entradaData['correo'],
            ]);

            $entradas[] = $entrada;
        }

        // Envío de correo
        $sesion = Sesion::where('id_sesion', $data[0]['id_sesion'])->first();
        $pelicula = Pelicula::where('id_pelicula', $sesion->id_pelicula)->first(); 
        Mail::to($data[0]['correo'])->send(new CompraEntradasConfirmation($entradas, $sesion, $pelicula));

        return response()->json($entradas, 200);
    }
}

