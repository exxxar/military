<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ShelterResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'city' => $this->city,
            'region' => $this->region,
            'address' => $this->address,
            'lat' => $this->lat,
            'lon' => $this->lon,
            'balance_holder' => $this->balance_holder,
            'responsible_person' => $this->responsible_person,
            'capacity' => $this->capacity,
            'description' => $this->description,
        ];
    }
}
