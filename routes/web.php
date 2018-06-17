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
});


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});


Route::group(['prefix' => 'donor'], function () {
    Route::get('/', 'DonorController@index');
    Route::post('/', 'DonorController@store');
    Route::get('/{id}', 'DonorController@show');
    Route::post('/update', 'DonorController@update');
    Route::get('/destroy/{id}', 'DonorController@destroy');
});

Route::group(['prefix' => 'donation'], function () {
    Route::get('/', 'DonationController@index');
    Route::post('/', 'DonationController@store');
    Route::get('/{id}', 'DonationController@show');
    Route::post('/update', 'DonationController@update');
    Route::get('/destroy/{id}', 'DonationController@destroy');
});

Route::group(['prefix' => 'post'], function () {
    Route::get('/', 'PostController@index');
    Route::get('/{id}', 'PostController@show');
});