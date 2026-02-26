<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\MascotasController;
use Illuminate\Support\Facades\Auth;
Route::get('/', function () {
    return view('modulos.users.Ingresar');
});

//route::get('CrearUsuario', [UsersController::class, 'create']);
Auth::routes();

Route::get('Inicio',[UsersController::class, 'Ajustes']);

Route::post('Inicio',[UsersController::class, 'ActualizarAjustes']);

Route::get('/Mis-Datos', function() {
    return view('modulos.users.Mis-Datos');
});

Route::put('Mis-Datos',[UsersController::class, 'ActualizarMisDatos']);

Route::get('Usuarios', [UsersController::class, 'index']);
Route::post('Usuarios', [UsersController::class, 'store']);
Route::get('Editar-Usuario/{id_usuario}', [UsersController::class, 'edit']);
Route::put('Actualizar-Usuario/{id_usuario}', [UsersController::class, 'update']);
Route::get('Eliminar-Usuario/{id_usuario}', [UsersController::class, 'destroy']);

Route::get('Clientes', [ClientesController::class, 'index']);
Route::get('Crear-Cliente', [ClientesController::class, 'create']);
Route::post('Crear-Cliente', [ClientesController::class, 'store']);
Route::get('Editar-Cliente/{id_cliente}', [ClientesController::class, 'edit']);
Route::put('Actualizar-Cliente/{id_cliente}', [ClientesController::class, 'update']);

Route::get ('Mascotas', [MascotasController::class, 'index']);
Route::post ('Mascotas', [MascotasController::class, 'store']);