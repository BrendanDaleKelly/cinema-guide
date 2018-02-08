<?php

use Illuminate\Http\Request;
use App\Cinema;
use App\Movie;
use App\Session;

Route::get('cinemas', 'CinemaController@index'); // Lists all cinemas
Route::get('cinema/{name}', 'CinemaController@show'); // Lists a single cinema
Route::get('cinema/{name}/movies'); // Lists all movies available at a cinema
Route::get('cinema/{name}/movies/{date}'); // lists all movies available at a cinema on a given date
Route::get('cinema/{name}/sessions/{date}'); // lists all sessions at a cinema on a given date
Route::get('cinema/{name}/{movie_title}/{date}'); // lists all sessions at a cinema on a given date for a given movie

Route::get('movies', 'MovieController@index'); // Lists all movies
Route::get('movie/{name}', 'MovieController@show'); // Lists a single movie

Route::get('sessions', 'SessionController@index'); // Lists all sessions
Route::get('sessions/{cinema_name}', 'SessionController@show'); // Lists sessions at a specific ciname
Route::get('sessions/{cinema_name}/{movie_title}', 'SessionController@show'); // Lists sessions at {cinema} for {movie}
Route::get('session/{id}', 'SessionController@index'); // Lists all sessions

Route::post('cinema', 'CinemaController@store'); // Creates a new cinema
Route::patch('cinema{id}', 'CinemaController@update'); // Updates a cinema
Route::delete('cinema/{id}', 'CinemaController@destroy'); // Deletes a cinema

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
