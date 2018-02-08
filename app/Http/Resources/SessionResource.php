<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;
use App\Cinema;
use App\Movie;

class SessionResource extends Resource
{
    // Transform the resource into an array.
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'date' => $this->date,
            'time' => $this->time,
            'cinema_name' => Cinema::findOrFail($this->cinema_id)->name,
            'movie_title' => Movie::findOrFail($this->movie_id)->title,
        ];
    }
}
