<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ejercicio;
use App\Models\Categoria;
use Illuminate\Support\Facades\Validator;

class EjerciciosController extends Controller
{
    public function consulta(Request $request)
    {
        $filtro = $request->filtro ?? null;
        $categoria = $request->categoria ?? null;
        $ejercicios = Ejercicio::consulta($filtro, $categoria);
        return response()->json($ejercicios, 200);
    }

    public function detalles($id)
    {
        $ejercicio = Ejercicio::consultaId($id);
        if (!$ejercicio) {
            return response()->json(['El ejercicio no existe'], 404);
        }

        $ejercicio->categoria = Categoria::find($ejercicio->idcategoria)->nombre;
        return response()->json($ejercicio, 200);
    }
}
