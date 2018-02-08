<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Session;
use App\Http\Resources\SessionResource;

class SessionController extends Controller
{
    // Get all the sessions and return them as a resource.
    public function index()
    {
        $sessions = Session::paginate(15);
        return SessionResource::collection($sessions);
    }

    // Get a single session by id and return it as a resource.
    public function show($id)
    {
        $session = Session::findOrFail($id);
        return new SessionResource($session);
    }
}
