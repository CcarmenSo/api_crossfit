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


}
