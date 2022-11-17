<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
/*
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
*/

Route::get('/users', 'App\Http\Controllers\RegisterController@index'); //mostrar todos

Route::post('/users', 'App\Http\Controllers\RegisterController@store'); //crear

Route::put('/users/{codigo}', 'App\Http\Controllers\RegisterController@update'); //actualizar

Route::delete('/users/{codigo}', 'App\Http\Controllers\RegisterController@destroy'); //eliminar