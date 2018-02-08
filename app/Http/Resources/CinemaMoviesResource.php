<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class CinemaMoviesResource extends Resource
{
    // Transform the resource into an array.
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'address' => $this->address,
            'url' => $this->url,
            'phone' => $this->phone,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'google_maps_link' => "http://www.google.com/maps/place/$this->latitude,$this->longitude",
            'movies' => MovieSessionsResource::collection($this->movies),
        ];
    }
}
