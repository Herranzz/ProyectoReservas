<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\UbicacionController;
use App\Http\Controllers\ReservasController;

Route::get('/', function () {
    return view('home');
})->middleware('auth');

//auth------------------------------------------------------------
Route::get('/login', [SessionsController::class, 'create'])->middleware('guest')->name('login.index');

Route::post('/login', [SessionsController::class, 'store'])->name('login.store');

Route::get('/logout', [SessionsController::class, 'destroy'])->middleware('auth')->name('login.destroy');

Route::get('/admin', [AdminController::class, 'index'])->middleware('auth.admin')->name('admin.index');
//------------------------------------------------------------

//gestion------------------------------------------------------------
Route::get('/admin/gestion', [AdminController::class, 'gestion'])->middleware('auth.admin')->name('admin.gestion');
//------------------------------------------------------------

//crud profesores------------------------------------------------------------
Route::get('/admin/gestion/usuarios', [RegisterController::class, 'index'])->middleware('auth.admin')->name('users.index');

Route::get('/admin/gestion/usuarios/crear', [RegisterController::class, 'create'])->middleware('auth.admin')->name('users.create');

Route::post('/admin/gestion/usuarios/crear', [RegisterController::class, 'store'])->name('users.store');

Route::get('/admin/gestion/usuarios/actualizar/{codigo}', [RegisterController::class, 'edit'])->name('users.edit');
Route::put('/admin/gestion/usuarios/{codigo}', [RegisterController::class, 'update'])->name('users.update');

Route::delete('/admin/gestion/usuarios/eliminar/{codigo}', [RegisterController::class, 'destroy'])->name('users.destroy');
//------------------------------------------------------------

//crud ubicaciones------------------------------------------------------------
Route::get('/admin/gestion/ubicaciones', [UbicacionController::class, 'index'])->middleware('auth.admin')->name('ubicaciones.index');

Route::get('/admin/gestion/ubicaciones/crear', [UbicacionController::class, 'create'])->middleware('auth.admin')->name('ubicaciones.create');

Route::post('/admin/gestion/ubicaciones/crear', [UbicacionController::class, 'store'])->name('ubicaciones.store');

Route::get('/admin/gestion/ubicaciones/actualizar/{id}', [UbicacionController::class, 'edit'])->name('ubicaciones.edit');

Route::put('/admin/gestion/ubicaciones/{id}', [UbicacionController::class, 'update'])->name('ubicaciones.update');

Route::delete('/admin/gestion/ubicaciones/eliminar/{id}', [UbicacionController::class, 'destroy'])->name('ubicaciones.destroy');
//------------------------------------------------------------

//crud reservas------------------------------------------------------------
Route::get('/admin/gestion/reservas', [ReservasController::class, 'index'])->middleware('auth.admin')->name('reservas.index');

Route::get('/admin/gestion/reservas/crear', [ReservasController::class, 'create'])->middleware('auth.admin')->name('reservas.create');

Route::post('/admin/gestion/reservas/crear', [ReservasController::class, 'store'])->name('reservas.store');

Route::get('/admin/gestion/reservas/actualizar/{id}', [ReservasController::class, 'edit'])->name('reservas.edit');

Route::put('/admin/gestion/reservas/{id}', [ReservasController::class, 'update'])->name('reservas.update');

Route::delete('/admin/gestion/reservas/eliminar/{id}', [ReservasController::class, 'destroy'])->name('reservas.destroy');

Route::get('/admin/gestion/reservas/ver/{id}', [ReservasController::class, 'show'])->name('reservas.show');
//------------------------------------------------------------

//reservas parte usuario noraml------------------------------------------------------------
Route::get('calendar-event', [ReservasController::class, 'index'])->name('fullcalender.index');
Route::post('calendar-crud-ajax', [ReservasController::class, 'calendarEvents']);
//------------------------------------------------------------