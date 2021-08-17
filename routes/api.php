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

Route::get("users", "App\Http\Controllers\Api\UsersController@getAllUsers");
Route::get("users/{email}", 'App\Http\Controllers\Api\UsersController@getUser');

Route::post("users", "App\Http\Controllers\Api\UsersController@save");
Route::post("users/auth", "App\Http\Controllers\Api\UsersController@auth");
Route::post("users/validate", "App\Http\Controllers\Api\UsersController@validate");

Route::post("users/update", "App\Http\Controllers\Api\UsersController@update");
Route::post("users/delete","App\Http\Controllers\Api\UsersController@delete");
