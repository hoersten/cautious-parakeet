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
Route::group(['middleware' => ['web','auth'], 'prefix' => 'account' ], function() {
  Route::get('/', 'UserController@show')->name('users.show');
  Route::get('/edit', 'UserController@edit')->name('users.edit');
  Route::patch('/', 'UserController@update')->name('users.update');
  Route::put('/', 'UserController@update')->name('users.update');
});
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
    Route::get('/create', 'HighlightController@create')->name('highlights.create');
    Route::post('/', 'HighlightController@store')->name('highlights.store');
    Route::get('/{highlight}', 'HighlightController@show')->name('highlights.show');
    Route::get('/{highlight}/edit', 'HighlightController@edit')->name('highlights.edit');
    Route::patch('/{highlight}', 'HighlightController@update')->name('highlights.update');
    Route::put('/{highlight}', 'HighlightController@update')->name('highlights.update');
    Route::delete('/{highlight}', 'HighlightController@destroy')->name('highlights.destroy');
    Route::group(['middleware' => 'web', 'prefix' => '{highlight}/pictures'], function() {
      Route::get('/create', 'PictureController@create')->name('pictures.create');
      Route::post('/', 'PictureController@store')->name('pictures.store');
      Route::get('/{picture}', 'PictureController@show')->name('pictures.show');
      Route::get('/{picture}/edit', 'PictureController@edit')->name('pictures.edit');
      Route::patch('/{picture}', 'PictureController@update')->name('pictures.update');
      Route::put('/{picture}', 'PictureController@update')->name('pictures.update');
      Route::delete('/{picture}', 'PictureController@destroy')->name('pictures.destroy');
    });
  });
});

Auth::routes();