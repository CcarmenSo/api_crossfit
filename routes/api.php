<?php



use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EjerciciosController;
use App\Http\Controllers\CategoriasController;


//..................ENDPOINTS PARA CONSULTA DE EJERCICIOS.....................

Route::get('/ejercicios', [EjerciciosController::class, 'consulta']);

Route::get('/ejercicios/{id}', [EjerciciosController::class, 'detalles']);



//.......................ENDPOINTS PARA CONSULTA DE CATEGORIAS.........

Route::get('/categorias', [CategoriasController::class, 'consulta']);

Route::get('/categorias/{id}/ejercicios', [CategoriasController::class, 'consultaEjercicios']);
