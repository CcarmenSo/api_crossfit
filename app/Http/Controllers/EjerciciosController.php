<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ejercicio;
use App\Models\Categoria;
use Illuminate\Support\Facades\Validator; 

class EjerciciosController extends Controller
{
    public function consulta(Request $request){
        $filtro = $request->filtro ?? null;
        $categoria = $request->categoria ?? null;
        $ejercicios = Ejercicio::consulta($filtro, $categoria);
        return response()->json($ejercicios,200);
    }

    public function detalles($id){
        $ejercicio = Ejercicio::consultaId($id);
         if (!$ejercicio) {
        return response()->json([ 'El ejercicio no existe'], 404);
        }

        $ejercicio->categoria = Categoria::find($ejercicio->idcategoria)->nombre;
        return response()->json($ejercicio, 200);
    }

    public function alta(Request $request){
        $datos = $request->all();
        $imagen = $request->file('imagen');

        if ($imagen) {
            $path = $imagen->store('ejercicios', 'public');
            $datos['imagen'] = 'storage/' . $path;  
        }
        $rules = [
        'nombre' => 'required|string|max:255',
        'idcategoria' => 'required|exists:categorias,id',
        'imagen' => 'nullable|image|max:2048',
            
        ];
        $messages = [
            'nombre.required' => 'El nombre del ejercicio es obligatorio.',
            'idcategoria.required' => 'Debe seleccionar una categoría válida.',
         ];

        $validator = Validator::make($datos, $rules, $messages);
        if($validator->fails()){
            $errores = $validator->getMessageBag()->all();
            return response()->json($errores, 400);
        }
        $ejercicio = Ejercicio::alta($datos);
        return response()->json($ejercicio, 201);
    }

    public function modificacion (Request $request, Ejercicio $ejercicio){
        if(!$ejercicio){
            return response()->json(['El ejercicio no existe'], 404);
        }
        $datos = $request->all();
        $imagen = $request->file('portada');
        $rules = [
            'nombre' => 'required|string|max:255',
            'idcategoria' => 'required|exists:categorias,id',
            'imagen' => 'nullable|image|max:2048',
          ];
        $messages = [
            'nombre.required' => 'El nombre del ejercicio es obligatorio.',
            'idcategoria.required' => 'Debe seleccionar una categoría válida.',
        ];

        $validator = Validator::make($datos, $rules, $messages);
        if($validator->fails()){
            $errores = $validator->getMessageBag()->all();
            return response()->json($errores, 400);
        }
             $ejercicio->update($datos);
             return response()->json($ejercicio, 200);
    }

    public function baja(Ejercicio $ejercicio){
        if(!$ejercicio){
            return response()->json(['pelicula no existe'], 404);
        }
        $ejercicio->delete();
        return response()->json([], 200);
    }
}
