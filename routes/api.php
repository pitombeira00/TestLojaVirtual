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


Route::post('/token/', 'Api\GenerateTokenController@register');

Route::middleware(['auth:sanctum'])->group(static function () {

    Route::get('/user/', 'Api\AuthController@index');
    Route::get('/user/', 'Api\AuthController@show');
    Route::post('/user/', 'Api\AuthController@create');
    Route::put('/user/', 'Api\AuthController@edit');
    Route::delete('/user/{id}', 'Api\AuthController@create');

});
