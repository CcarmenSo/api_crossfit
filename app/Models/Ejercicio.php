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

    //método estatico para consultar los datos de la categoria de cada pelicula utilizando el método Elocuent belongsTo()

}
