<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/** Usuários */

Route::get("usuarios", "App\Http\Controllers\Api\UsuariosController@getAllUsuarios");
Route::get("usuarios/{email}", 'App\Http\Controllers\Api\UsuariosController@getUsuario');

Route::post("usuarios", "App\Http\Controllers\Api\UsuariosController@salvar");
Route::post("usuarios/auth", "App\Http\Controllers\Api\UsuariosController@autenticar");
Route::post("usuarios/validate", "App\Http\Controllers\Api\UsuariosController@validar");
Route::post("usuarios/update", "App\Http\Controllers\Api\UsuariosController@atualizar");
Route::post("usuarios/delete","App\Http\Controllers\Api\UsuariosController@deletar");

/** Cursos */

Route::get("cursos", "App\Http\Controllers\Api\CursosController@getAllCursos");
Route::get("cursos/{email}", 'App\Http\Controllers\Api\CursosController@getCurso');

Route::post("cursos", "App\Http\Controllers\Api\CursosController@salvar");
Route::post("cursos/update", "App\Http\Controllers\Api\CursosController@atualizar");
Route::post("cursos/delete","App\Http\Controllers\Api\CursosController@deletar");


