<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\MascotasController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CitasController;

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
Route::put('Usuarios', [UsersController::class, 'store']);
Route::get('Editar-Usuario/{id_usuario}', [UsersController::class, 'edit']);
Route::put('Actualizar-Usuario/{id_usuario}', [UsersController::class, 'update']);
Route::get('Eliminar-Usuario/{id_usuario}', [UsersController::class, 'destroy']);

Route::get('Clientes', [ClientesController::class, 'index']);
Route::get('Crear-Cliente', [ClientesController::class, 'create']);
Route::post('Crear-Cliente', [ClientesController::class, 'store']);
Route::get('Editar-Cliente/{id_cliente}', [ClientesController::class, 'edit']);
Route::put('Actualizar-Cliente/{id_cliente}', [ClientesController::class, 'update']);

Route::get ('Mascotas', [MascotasController::class, 'index']);
Route::put ('Mascotas', [MascotasController::class, 'store']);
Route::get ('Ver-Mascotas/{id_cliente}', [MascotasController::class, 'VerMascotasCliente']);
Route::get ('Editar-Mascota/{id_mascota}', [MascotasController::class, 'edit']);
Route::put ('Actualizar-Mascota/{id_mascota}', [MascotasController::class, 'update']);
Route::get ('Vacunas/{id_mascota}', [MascotasController::class, 'VacunasMascota']);
Route::post ('Vacunas/{id_mascota}', [MascotasController::class, 'AgregarVacuna']);
Route::get ('Carnet-Vacunas-PDF/{id_mascota}', [MascotasController::class, 'CarnetVacunasPDF']);
Route::get ('Eliminar-Mascota/{id_mascota}', [MascotasController::class, 'destroy']);

Route::get('Veterinarios', [CitasController::class, 'VerVeterinarios']);
Route::post('Veterinarios', [CitasController::class, 'CrearVeterinarios']);
Route::put('Estado/{id_veterinario}', [CitasController::class, 'CambiarEstadoVeterinario']);

Route::get('Citas', [CitasController::class, 'index']);
Route::get('Calendario/{id_veterinario}', [CitasController::class, 'Calendario']);
Route::get('Obtener-Mascotas/{id_cliente}', [CitasController::class, 'ObtenerMascotas']);
Route::post('Calendario/{id_veterinario}', [CitasController::class, 'AgendarCita']);
Route::delete('Cancelar-Cita', [CitasController::class, 'CancelarCita']);

Route::get('Citas-Hoy/{id_veterinario}', [CitasController::class, 'VerCitasHoyVeterinario']);
Route::post('Citas-Hoy/{id_veterinario}', [CitasController::class, 'CambiarEstadoCita']);
Route::get('Cita/{id_cita}', [CitasController::class, 'VerCita']);
Route::post('Finalizar-Cita/{id_cita}', [CitasController::class, 'FinalizarCita']);
Route::post('Cita/{id_cita}', [CitasController::class, 'HistorialCita']);
Route::put('Cita-Historial-Imagen/{id_cita}', [CitasController::class, 'ImgHistorial']);
Route::delete('Cita-Historial-Imagen-Borrar/{id_imagen}', [CitasController::class, 'BorrarImgHistorial']);

Route::get('Historial/{id_mascota}', [CitasController::class, 'HistorialMascota']);

Route::post('Receta/{id_cita}', [CitasController::class, 'Receta']);
Route::get('Receta-PDF/{id_receta}', [CitasController::class, 'RecetaPDF']);