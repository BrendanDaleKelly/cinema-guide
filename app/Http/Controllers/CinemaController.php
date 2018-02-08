<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Cinema;
use App\Http\Resources\CinemaResource;

class CinemaController extends Controller
{
    // Get all the cinemas and return them as a resource.
    public function index()
    {
        $cinemas = Cinema::paginate(15);
        return CinemaResource::collection($cinemas);
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

    public function show($id)
    {
        // Get a single cinema.
        $cinema = Cinema::findOrFail($id);

        // Return the cinema as a resource.
        return new CinemaResource($cinema);
    }

    // Update a cinema listing.
    public function update(Request $request, $id)
    {
        $cinema = Cinema::findOrFail($request->id);

        // Checking that each field is set allows the user to leave some fields out of the update.
        $cinema->id = $request->input('id');
        if (null !== $request->input('name')) $cinema->name = $request->input('name');
        if (null !== $request->input('address')) $cinema->address = $request->input('address');
        if (null !== $request->input('url')) $cinema->url = $request->input('url');
        if (null !== $request->input('phone')) $cinema->phone = $request->input('phone');
        if (null !== $request->input('latitude')) $cinema->latitude = $request->input('latitude');
        if (null !== $request->input('longitude')) $cinema->longitude = $request->input('longitude');

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
