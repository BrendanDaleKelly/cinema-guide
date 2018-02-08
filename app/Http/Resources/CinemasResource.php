<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class CinemasResource extends Resource
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
        ];
    }
}
