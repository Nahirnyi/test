<?php

use Illuminate\Http\Request;

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

Route::post('/register', 'Auth\RegisterController@store');
Route::post('/login', 'Auth\LoginController@store');

Route::resource('/companies', 'Api\CompaniesController', ['except' => ['create', 'edit']]);
Route::resource('/companies/{company}/ships', 'Api\ShipsController', ['except' => ['create', 'edit']]);
Route::resource('/ships/{ship}/containers', 'Api\ContainersController', ['except' => ['create', 'edit']]);
Route::resource('/ships/{ship}/routes', 'Api\RoutesController', ['except' => ['create', 'edit']]);
Route::resource('/routes/{route}/tracks', 'Api\TracksController', ['except' => ['create', 'edit']]);
