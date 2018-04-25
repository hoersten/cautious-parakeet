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

Route::get('/', 'StaticController@home')->name('home');
// Trips
Route::group(['middleware' => ['web','auth'], 'prefix' => 'trips'], function() {
  Route::get('/', 'TripController@index')->name('trips.index');
  Route::get('/create', 'TripController@create')->name('trips.create');
  Route::post('/', 'TripController@store')->name('trips.store');
  Route::get('/{trip}', 'TripController@show')->name('trips.show');
  Route::get('/{trip}/edit', 'TripController@edit')->name('trips.edit');
  Route::patch('/{trip}', 'TripController@update')->name('trips.update');
  Route::put('/{trip}', 'TripController@update')->name('trips.update');
  Route::delete('/{trip}', 'TripController@destroy')->name('trips.destroy');
  Route::group(['middleware' => 'web', 'prefix' => 'highlights'], function() {
    Route::get('/', 'HighLightsController@index')->name('highlights.index');
    Route::get('/create', 'HighLightsController@create')->name('highlights.create');
    Route::post('/', 'HighLightsController@store')->name('highlights.store');
    Route::get('/{highlight}', 'HighLightsController@show')->name('highlights.show');
    Route::get('/{highlight}/edit', 'HighLightsController@edit')->name('highlights.edit');
    Route::patch('/{highlight}', 'HighLightsController@update')->name('highlights.update');
    Route::put('/{highlight}', 'HighLightsController@update')->name('highlights.update');
    Route::delete('/{highlight}', 'HighLightsController@destroy')->name('highlights.destroy');
  });
});

Auth::routes();