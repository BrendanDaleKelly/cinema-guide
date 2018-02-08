<?php

use Illuminate\Http\Request;
use App\Cinema;
use App\Movie;
use App\Session;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'auth:api'], function() {
    Route::get('cinemas', 'CinemaController@index'); // Lists all cinemas
    Route::get('cinema/{name}', 'CinemaController@show'); // Lists a single cinema
    Route::get('cinema/{name}/movies', 'CinemaController@showMovies'); // Lists all movies & sessions available at a cinema
    Route::get('cinema/{name}/movies/{date?}', 'CinemaController@showMovies'); // lists all movies & sessions available at a cinema on a given date

    Route::get('movies', 'MovieController@index'); // Lists all movies
    Route::get('movie/{name}', 'MovieController@show'); // Lists a single movie

    Route::get('sessions', 'SessionController@index'); // Lists all sessions
    Route::get('session/{id}', 'SessionController@show'); // Lists a single session

    Route::post('cinema', 'CinemaController@store'); // Creates a new cinema
    Route::patch('cinema/{id}', 'CinemaController@update'); // Updates a cinema
    Route::delete('cinema/{id}', 'CinemaController@destroy'); // Deletes a cinema
});

Route::post('register', 'Auth\RegisterController@register');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout');
