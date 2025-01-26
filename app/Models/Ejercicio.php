<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ejercicio extends Model
{

    public $timestamps = false;
    protected $table = 'ejercicios';
    protected $primaryKey = 'id';

    //Atributos de la tabla que se van a informar de forma externa en el alta
    protected $fillable = [
        'nombre',
        'idcategoria',
        'direccion',
        'nivel',
        'video',

    ];


    public function categoria (){
        return $this->belongsTo(Categoria::class, 'idcategoria', 'id');
    }



    public static function consulta($filtro, $categoria){
        if($categoria){
            $ejercicios = Ejercicio::where('nombre', 'like', "%$filtro%")->where('idcategoria', $categoria)
            ->orderBy('nombre')
            ->get();
        } else{
            $ejercicios = Ejercicio::where('nombre', 'like', "%$filtro%")
            ->orderBy('nombre')
            ->get();
        }

        foreach ($ejercicios as $ejercicio){
            $ejercicio->categoria;

        }
        return $ejercicios;
    }


    public static function consultaId($id){
        $ejercicio = Ejercicio::find($id);
        if($ejercicio){
        $ejercicio->categoria;
        $ejercicio->imagen = env('URL_IMAGES').$ejercicio->imagen;
        }
        return $ejercicio;

    }



}

