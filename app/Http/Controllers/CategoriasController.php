<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelicula;
use App\Models\Categoria;
use Illuminate\Support\Facades\Validator; 

class CategoriasController extends Controller
{
    public function consulta(){
        $categoria = Categoria::consulta();
        return response()->json($categoria, 200);
    }

    public function consultaEjercicios($id){
        $categorias = Categoria::consultaEjercicios($id);
        return response()->json($categorias, 200);
    }

    public function alta(Request $request){
        $datos = $request->all();
        $rules = [
            'nombre' => 'required|string|max:255|unique:categorias', 
        ];
    
        
        $messages = [
            'nombre.required' => 'El nombre de la categoría es obligatorio.',
            'nombre.string' => 'El nombre de la categoría debe ser una cadena de texto.',
            'nombre.max' => 'El nombre de la categoría no puede superar los 255 caracteres.',
            'nombre.unique' => 'El nombre de la categoría ya está registrado.',
        ];

        $validator = Validator::make($datos, $rules, $messages);
        if($validator->fails()){
            $errores = $validator->getMessageBag()->all();
            return response()->json($errores, 400);
        }

        $categoria = Categoria::create($datos);
        return response()->json($categoria,201);
             
    }

    public function modificar(Request $request, Categoria $categoria){
        if(!$categoria){
            return response()->json(['categoria no existe'], 404);
        }
        $datos = $request->all();
        $rules = [
            'nombre' => 'required|string|max:255|unique:categorias,', 
        ];
    
        
        $messages = [
            'nombre.required' => 'El nombre de la categoría es obligatorio.',
            'nombre.string' => 'El nombre de la categoría debe ser una cadena de texto.',
            'nombre.max' => 'El nombre de la categoría no puede superar los 255 caracteres.',
            'nombre.unique' => 'El nombre de la categoría ya está registrado.',
        ];


        $validator = Validator::make($datos, $rules, $messages);
        if($validator->fails()){
            $errores = $validator->getMessageBag()->all();
            return response()->json($errores, 400);
        }
        $categoria->update($datos);
        return response()->json($categoria,200);
    }

    public function baja(Categoria $categoria){
        if(!$categoria){
            return response()->json(['categoria no existe'], 404);
        }
        $deleted = $categoria->delete();
        if($deleted){
            return response()->json([], 200);
        }else{
            return response()->json('error en la baja', 500);
        }
    }
}
