<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AidCenterResource extends JsonResource
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
            'phone' => $this->phone,
            'required' => $this->required,
            'description' => $this->description,
        ];
    }
}
