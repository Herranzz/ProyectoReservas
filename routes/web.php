<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    return view('home');
})->middleware('auth');

Route::get('/register', [RegisterController::class, 'create'])->middleware('guest')->name('register.index');

Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

Route::get('/login', [SessionsController::class, 'create'])->middleware('guest')->name('login.index');

Route::post('/login', [SessionsController::class, 'store'])->name('login.store');

Route::get('/logout', [SessionsController::class, 'destroy'])->middleware('auth')->name('login.destroy');

Route::get('/admin', [AdminController::class, 'index'])->middleware('auth.admin')->name('admin.index');

Route::get('/admin/gestion', [AdminController::class, 'gestion'])->middleware('auth.admin')->name('admin.gestion');

Route::get('/admin/gestion/profesores', [AdminController::class, 'profesores'])->middleware('auth.admin')->name('admin.gestion.profesores');