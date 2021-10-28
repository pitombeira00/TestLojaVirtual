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

    Route::get('/user/', 'Api\AuthIndexController');
    Route::get('/user/{id}', 'Api\AuthShowController');
    Route::post('/user/', 'Api\AuthCreateController');
    Route::put('/user/{id}', 'Api\AuthEditController');
    Route::delete('/user/{id}', 'Api\AuthDeleteController');

});
