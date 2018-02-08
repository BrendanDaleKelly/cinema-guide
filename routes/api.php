<?php

use Illuminate\Http\Request;
use App\Cinema;
use App\Movie;
use App\Session;

// List all cinemas
Route::get('cinemas', 'CinemaController@index');

// List a single cinema
Route::get('cinema/{id}', 'CinemaController@show');

// Create a new cinema
Route::post('cinema', 'CinemaController@store');

// Update a cinema
Route::patch('cinema{id}', 'CinemaController@update');

// Delete a cinema
Route::delete('cinema/{id}', 'CinemaController@destroy');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
