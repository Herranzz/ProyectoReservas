<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UbicacionController;
use App\Http\Controllers\ReservasController;
use App\Http\Controllers\EquiposController;
use App\Http\Controllers\TiposController;
use App\Http\Controllers\EstadoController;
use App\Http\Controllers\InventarioController;

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

//crud tipos de equipos------------------------------------------------------------
Route::get('/admin/gestion/tipos', [TiposController::class, 'index'])->middleware('auth.admin')->name('tipos.index');

Route::get('/admin/gestion/tipos/crear', [TiposController::class, 'create'])->middleware('auth.admin')->name('tipos.create');

Route::post('/admin/gestion/tipos/crear', [TiposController::class, 'store'])->name('tipos.store');

Route::get('/admin/gestion/tipos/actualizar/{id}', [TiposController::class, 'edit'])->name('tipos.edit');

Route::put('/admin/gestion/tipos/{id}', [TiposController::class, 'update'])->name('tipos.update');

Route::delete('/admin/gestion/tipos/eliminar/{id}', [TiposController::class, 'destroy'])->name('tipos.destroy');
//------------------------------------------------------------

//crud equipos------------------------------------------------------------
Route::get('/admin/gestion/equipos', [EquiposController::class, 'index'])->middleware('auth.admin')->name('equipos.index');

Route::get('/admin/gestion/equipos/crear', [EquiposController::class, 'create'])->middleware('auth.admin')->name('equipos.create');

Route::post('/admin/gestion/equipos/crear', [EquiposController::class, 'store'])->name('equipos.store');

Route::get('/admin/gestion/equipos/actualizar/{id}', [EquiposController::class, 'edit'])->name('equipos.edit');

Route::put('/admin/gestion/equipos/{id}', [EquiposController::class, 'update'])->name('equipos.update');

Route::delete('/admin/gestion/equipos/eliminar/{id}', [EquiposController::class, 'destroy'])->name('equipos.destroy');
//------------------------------------------------------------

//crud estados------------------------------------------------------------
Route::get('/admin/gestion/estados', [EstadoController::class, 'index'])->middleware('auth.admin')->name('estados.index');

Route::get('/admin/gestion/estados/crear', [EstadoController::class, 'create'])->middleware('auth.admin')->name('estados.create');

Route::post('/admin/gestion/estados/crear', [EstadoController::class, 'store'])->name('estados.store');

Route::get('/admin/gestion/estados/actualizar/{id}', [EstadoController::class, 'edit'])->name('estados.edit');

Route::put('/admin/gestion/estados/{id}', [EstadoController::class, 'update'])->name('estados.update');

Route::delete('/admin/gestion/estados/eliminar/{id}', [EstadoController::class, 'destroy'])->name('estados.destroy');
//------------------------------------------------------------

//crud inventario------------------------------------------------------------
Route::get('/admin/gestion/inventario', [InventarioController::class, 'index'])->middleware('auth.admin')->name('inventario.index');

Route::get('/admin/gestion/inventario/crear', [InventarioController::class, 'create'])->middleware('auth.admin')->name('inventario.create');

Route::post('/admin/gestion/inventario/crear', [InventarioController::class, 'store'])->name('inventario.store');

Route::get('/admin/gestion/inventario/actualizar/{id}', [InventarioController::class, 'edit'])->name('inventario.edit');

Route::put('/admin/gestion/inventario/{id}', [InventarioController::class, 'update'])->name('inventario.update');

Route::delete('/admin/gestion/inventario/eliminar/{id}', [InventarioController::class, 'destroy'])->name('inventario.destroy');
//------------------------------------------------------------