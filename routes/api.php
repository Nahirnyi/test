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

Route::resource('/companies', 'Api\Ship\CompaniesController', ['except' => ['create', 'edit']]);
Route::resource('/companies/{company}/ships', 'Api\ShipsController', ['except' => ['create', 'edit']]);
Route::resource('/ships/{ship}/containers', 'Api\Ship\ContainersController', ['except' => ['create', 'edit']]);
Route::resource('/ships/{ship}/routes', 'Api\Ship\RoutesController', ['except' => ['create', 'edit', 'update']]);
Route::get('/ships/{ship}/routes/{route}/gpx', 'Api\Ship\RoutesController@makeGpx');
Route::resource('/routes/{route}/tracks', 'Api\Ship\TracksController', ['only' => 'index']);

Route::resource('/containers', 'Api\ContainersController', ['except' => ['create', 'edit']]);
Route::resource('/routes', 'Api\RoutesController', ['except' => ['create', 'edit', 'update']]);
Route::resource('/tracks', 'Api\TracksController', ['only' => 'store']);

Route::get('/statistics/{key}', 'Api\Statistic\StatisticsController@show');
