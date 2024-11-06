<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    public $timestamps = false;
    protected $table = 'categoria';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nombre',
    ];

    //En funcion de si la categoria llega informada EL id o no, realizamos la consulta de una categoria o de todas las categroias
    public static function consulta ($id = null){
        if($id){
            return Categoria::where('id', $id)->get();
        }else{
            return Categoria::orderBy('nombre')->get();
        }
    }

    //Hasmany nos permite acceder a todas las peliculas de una categoria
    public function ejercicios(){
        return $this->hasMany(Ejercicio::class, 'idcategoria', 'id');
    }

    
    //consultarremos solo la categoria que nos llega por parametro o todas si no nos llega ninguna
  
    public static function consultaEjercicios($id = null) {
        if ($id) {
            $categorias = Categoria::where('id', $id)->get();
        } else {
            $categorias = Categoria::orderBy('nombre')->get();
        }
    
        foreach ($categorias as $categoria) {
            $categoria->ejercicios->each(function($ejercicio) {
            $ejercicio->imagen = env('URL_IMAGES').$ejercicio->imagen;
            });
        }
    
        return $categorias;
    }
    
    
 
}

