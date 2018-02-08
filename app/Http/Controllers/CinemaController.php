<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cinema;
use App\Movie;
use App\Session;
use App\Http\Resources\CinemaResource;
use App\Http\Resources\MovieResource;
use App\Http\Resources\CinemaMoviesResource;

class CinemaController extends Controller
{
    // Get all the cinemas and return them as a resource.
    public function index()
    {
        $cinemas = Cinema::paginate(15);
        return CinemaResource::collection($cinemas);
    }

    // Get a single cinema by name and return it as a resource.
    public function show($name)
    {
        $cinema = Cinema::where('name', $name)->firstOrFail();
        return new CinemaResource($cinema);
    }

    // Get all movies showing at a cinema.
    public function showMovies($name, $date = null)
    {
        // Find the desired cinema and its sessions. Filter by date if available.
        $cinema = Cinema::where('name', $name)->firstOrFail();
        if ($date !== null) {
            $sessions = Session::where([['cinema_id', $cinema->id], ['date', $date]])->get();
        } else {
            $sessions = Session::where('cinema_id', $cinema->id)->get();
        }

        // Get each unique movie
        $movieIDs = $seenIDs = [];
        foreach ($sessions as $session) {
            if (in_array($session->movie_id, $seenIDs, true)) continue;
            $seenIDs[] = $session->movie_id;
            $movieIDs[] = $session->movie_id;
        }
        $cinema['movies'] = Movie::find($movieIDs);

        // Add session times to each movie.
        foreach ($cinema['movies'] as &$movie) {
            if ($date !== null) {
                $movie['sessions'] = Session::where([['cinema_id', $cinema->id], ['movie_id', $movie->id], ['date', $date]])->get();
            } else {
                $movie['sessions'] = Session::where([['cinema_id', $cinema->id], ['movie_id', $movie->id]])->get();
            }
        } // ^ would be more efficient to use $sessions for this data rather than pull it out of the db again.

        // Return the amalgamated data as a resource.
        return new CinemaMoviesResource($cinema);
    }

    // Create a new cinema listing.
    public function store(Request $request)
    {
        $cinema = new Cinema;

        $cinema->id = $request->input('id');
        $cinema->name = $request->input('name');
        $cinema->address = $request->input('address');
        $cinema->url = $request->input('url');
        $cinema->phone = $request->input('phone');
        $cinema->latitude = $request->input('latitude');
        $cinema->longitude = $request->input('longitude');

        if ($cinema->save()) {
            return new CinemaResource($cinema);
        }
    }

    // Update a cinema listing.
    public function update(Request $request, $id)
    {
        $cinema = Cinema::findOrFail($request->id);

        // Checking that each field is set allows the user to leave some fields out of the update.
        if ($request->input('name') !== null) $cinema->name = $request->input('name');
        if ($request->input('address') !== null) $cinema->address = $request->input('address');
        if ($request->input('url') !== null) $cinema->url = $request->input('url');
        if ($request->input('phone') !== null) $cinema->phone = $request->input('phone');
        if ($request->input('latitude') !== null) $cinema->latitude = $request->input('latitude');
        if ($request->input('longitude') !== null) $cinema->longitude = $request->input('longitude');

        if ($cinema->save()) {
            return new CinemaResource($cinema);
        }
    }

    // Delete a cinema listing, then return the deleted cinema.
    public function destroy($id)
    {
        $cinema = Cinema::findOrFail($id);

        if ($cinema->delete()) {
            return new CinemaResource($cinema);
        }
    }
}
