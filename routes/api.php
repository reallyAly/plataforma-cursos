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

Route::get("users", "UserController@getAllUsers");
Route::get("users/{id}", 'UserController@');

Route::post("users", "UserController@save");
Route::post("users/auth", "UserController@auth");
Route::post("users/validate", "UserController@validate");

Route::put("users/{id}", "UserController@update");
Route::delete("users/{id}","UserController@delete");
