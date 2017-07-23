<?php

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

Route::group(['middleware' => 'auth'], function () {
    Route::get('cars', "Api\\CarController@getCars");
    Route::get('cars/{id}', "Api\\CarController@getOneCar");
    Route::resource('admin/cars', "Api\\Admin\\AdminCarController", ['except' => ['create','edit']]);
});
