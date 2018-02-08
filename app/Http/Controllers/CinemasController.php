<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cinemas;

class CinemasController extends Controller
{
    public function index() {
        $cinemas = Cinemas::all();
        return response()->json($cinemas, 200);
    }
}
