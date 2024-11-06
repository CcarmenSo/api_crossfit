<?php



use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EjerciciosController;
use App\Http\Controllers\CategoriasController;


//..................ENDPOINTS PARA CONSULTA DE EJERCICIOS.....................
//Consulta de todas las ejercicios
Route::get('/ejercicios', [EjerciciosController::class, 'consulta']);

//Consulta detalle de un ejercicio
Route::get('/ejercicios/{id}', [EjerciciosController::class, 'detalles']);

//Creación de un recurso de tipo ejercicio
Route::post('/ejercicios', [EjerciciosController::class, 'alta']);

//Modificación de un recurso ejercicio
Route::put('/ejercicios/{ejercicio}', [EjerciciosController::class, 'modificacion']);

//Baja de un recurso ejercicio
Route::delete('/ejercicios/{ejercicio}', [EjerciciosController::class, 'baja']);

//.......................ENDPOINTS PARA CONSULTA DE CATEGORIAS.........
//Consulta de todas las categorias
Route::get('/categorias',[CategoriasController::class, 'consulta']);

//Consulra de una categoria y las peliculas asociadas
Route::get('/categorias/{id}/ejercicios',[CategoriasController::class, 'consultaEjercicios']);

//Creación de un recurso tipo categoria
Route::post('/categorias',[CategoriasController::class, 'alta']);


//Modificación de un recurso categoría
Route::put('/categorias/{categoria}',[CategoriasController::class, 'modificar']);

//Baja de un recurso categoría
Route::delete('/categorias/{categoria}',[CategoriasController::class, 'baja']);