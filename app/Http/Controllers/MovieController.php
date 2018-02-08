<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Movie;
use App\Http\Resources\MovieResource;

class MovieController extends Controller
{
    // Get all the movies and return them as a resource.
    public function index()
    {
        $movies = Movie::paginate(15);
        return MoviesResource::collection($movies);
    }

    // Get a single movie by name and return it as a resource.
    public function show($name)
    {
        $movie = Movie::where('name', $name)->firstOrFail();
        return new MovieResource($movie);
    }
}
