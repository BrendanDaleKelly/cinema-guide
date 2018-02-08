<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class MoviesResource extends Resource
{
    // Transform the resource into an array.
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'poster' => $this->poster,
            'trailer' => $this->trailer,
        ];
    }
}
