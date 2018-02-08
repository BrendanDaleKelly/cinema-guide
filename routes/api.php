<?php

use Illuminate\Http\Request;
use App\Cinemas;
use App\Movies;
use App\Sessions;

Route::get('cinemas', 'CinemasController@index');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
