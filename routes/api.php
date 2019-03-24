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


Route::post('GetContinents', 'ContinentController@GetContinents');
Route::post('GetContinent', 'ContinentController@GetContinent');
Route::post('AddContinent', 'ContinentController@AddContinent');
Route::post('UpdateContinent', 'ContinentController@UpdateContinent');
Route::post('DeleteContinent', 'ContinentController@DeleteContinent');