<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;
use App\Cinema;
use App\Movie;

class SessionsResource extends Resource
{
    // Transform the resource into an array.
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'time' => $this->time,
            'cinema' => Cinema::findOrFail($this->cinema_id),
            'movie' => Movie::findOrFail($this->movie_id),
        ];
    }
}
