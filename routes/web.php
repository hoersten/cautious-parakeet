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
  Route::group(['middleware' => 'web', 'prefix' => '{trip}/highlights'], function() {
    Route::get('/create', 'HighLightController@create')->name('highlights.create');
    Route::post('/', 'HighLightController@store')->name('highlights.store');
    Route::get('/{highlight}', 'HighLightController@show')->name('highlights.show');
    Route::get('/{highlight}/edit', 'HighLightController@edit')->name('highlights.edit');
    Route::patch('/{highlight}', 'HighLightController@update')->name('highlights.update');
    Route::put('/{highlight}', 'HighLightController@update')->name('highlights.update');
    Route::delete('/{highlight}', 'HighLightController@destroy')->name('highlights.destroy');
  });
});

Auth::routes();