<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('index');

Route::group(['middleware' => 'auth'], function() {
    Route::resource('cars', "Resource\\ResourceCarController");
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('auth/github', 'Auth\\Github\\LoginController@redirectToProvider')->name('github.auth');
Route::get('auth/github/callback', 'Auth\\Github\\LoginController@handleProviderCallback')->name('github.callback');

Route::get('auth/google', 'Auth\\Google\\LoginController@redirectToProvider')->name('google.auth');
Route::get('auth/google/callback', 'Auth\\Google\\LoginController@handleProviderCallback')->name('google.callback');

