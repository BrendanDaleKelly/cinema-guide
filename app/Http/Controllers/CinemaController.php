<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cinema;

class CinemasController extends Controller
{
    public function index() {
        $cinemas = Cinema::all();
        return response()->json($cinemas, 200);
    }
}
