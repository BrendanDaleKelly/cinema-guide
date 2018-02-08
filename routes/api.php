<?php

use Illuminate\Http\Request;
use App\Cinema;
use App\Movie;
use App\Session;

Route::get('cinemas', 'CinemasController@index');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
