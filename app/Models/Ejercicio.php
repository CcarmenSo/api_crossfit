<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ejercicio extends Model
{

    //Desactivamos timestamp e informamos de la tabla y su clave primaria si no siguen las convecciones de Laravel
    public $timestamps = false;
    protected $table = 'ejercicios';
    protected $primaryKey = 'id';

    //Atributos de la tabla que se van a informar de forma externa en el alta
    protected $fillable = [
        'nombre',
        'idcategoria',
        'direccion',
        'nivel',
        'imagen',
        'video',
        
    ];

    //método NO estatico para consultar los datos de la categoria de cada ejercicios utilizando el método Elocuent belongsTo()
    //Esto indica que los ejercicios pertenecen a categoria, idcategoria es la clave foranea e id es la clave primaria
    public function categoria (){
        return $this->belongsTo(Categoria::class, 'idcategoria', 'id');
    }

    //Creamos el modelo de consulta de todos los ejercicios por filtro de nombre de pelicula y de id categoria

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
            $ejercicio->imagen = env('URL_IMAGES').$ejercicio->imagen;
        }
        return $ejercicios;
    }
    
    //metodo para consultar el ejercicio por su id
    public static function consultaId($id){
        $ejercicio = Ejercicio::find($id);
        if($ejercicio){
        $ejercicio->categoria;
        $ejercicio->imagen = env('URL_IMAGES').$ejercicio->imagen;
        }
        return $ejercicio;

    }

    //metodo para dar de alta una pelicula a través del array de datos que llegue en el parametro de entrada
    public function alta($datos){
        return Ejercicio::create([
        'nombre'=>$datos['nombre'],
        'idcategoria'=>$datos['idcategoria'],
        'direccion'=>$datos['direccion'],
        'nivel'=>$datos['nivel'],
        'imagen'=>$datos['imagen'],
        'video'=>$datos['video'],
        ]);
    }

}
