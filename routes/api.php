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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/** Usuários */
Route::get("usuarios", "App\Http\Controllers\Api\UsuariosController@getAllUsuarios");
Route::get("usuarios/{email}", 'App\Http\Controllers\Api\UsuariosController@getUsuario');

Route::post("usuarios", "App\Http\Controllers\Api\UsuariosController@salvar");
Route::post("usuarios/auth", "App\Http\Controllers\Api\UsuariosController@autenticar");
Route::post("usuarios/validate", "App\Http\Controllers\Api\UsuariosController@validarUsuario");
Route::post("usuarios/update", "App\Http\Controllers\Api\UsuariosController@atualizar");
Route::post("usuarios/delete","App\Http\Controllers\Api\UsuariosController@deletar");


/** Cursos */
Route::get("cursos", "App\Http\Controllers\Api\CursosController@getAllCursos");
Route::get("cursos/{id_curso}", 'App\Http\Controllers\Api\CursosController@getCurso');

Route::post("cursos", "App\Http\Controllers\Api\CursosController@salvar");
Route::post("cursos/update", "App\Http\Controllers\Api\CursosController@atualizar");
Route::post("cursos/delete","App\Http\Controllers\Api\CursosController@deletar");

/** Certificados */
Route::get("certificados", "App\Http\Controllers\Api\CertificadosController@getAllCertificados");
Route::get("certificados/{hash_certificado}", 'App\Http\Controllers\Api\CertificadosController@getCertificado');
Route::get("certificados/validate/{hash_certificado}", 'App\Http\Controllers\Api\CertificadosController@validaCertificado');
Route::post("certificados", "App\Http\Controllers\Api\CertificadosController@salvar");

/** Compras */
Route::get("compras", "App\Http\Controllers\Api\ComprasController@getAllCompras");
Route::get("compras/{id_compra}", 'App\Http\Controllers\Api\ComprasController@getCompra');
Route::post("compras", "App\Http\Controllers\Api\ComprasController@salvar");

/** CursoUsuario */
Route::get("cursoUsuario/{id_usuario}", 'App\Http\Controllers\Api\CursosUsuarioController@getAllCursosDoUsuario');

/** InfoVideo */
Route::get("infovideo/{id_curso}", "App\Http\Controllers\Api\InfoVideoController@getAllVideosDoCurso");
Route::get("infovideo/video/{id_video}", "App\Http\Controllers\Api\InfoVideoController@getVideo");
Route::post("infovideo", "App\Http\Controllers\Api\InfoVideoController@salvar");
Route::post("infovideo/delete", "App\Http\Controllers\Api\InfoVideoController@deletar");
Route::post("infovideo/update", "App\Http\Controllers\Api\InfoVideoController@atualizar");

/** Etapas */
Route::get("etapas/{id_curso}", "App\Http\Controllers\Api\EtapasController@getAllEtapasDoCurso");
Route::get("etapas/nomes/{id_curso}", "App\Http\Controllers\Api\EtapasController@getAllNomesEtapasDoCurso");

Route::post("etapas/update", "App\Http\Controllers\Api\EtapasController@atualizar");
Route::post("etapas", "App\Http\Controllers\Api\EtapasController@salvar");
Route::post("etapas/delete", "App\Http\Controllers\Api\EtapasController@deletar");

/** VideoUsuario **/
Route::post("videousuario/adicionarvideo", "App\Http\Controllers\Api\VideoUsuarioController@adicionarVideo");