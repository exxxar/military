<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class MessageResource extends JsonResource
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
            'full_name' => $this->full_name,
            'sms' => $this->sms,
            'identify' => $this->identify,
            'h_user_id' => $this->h_user_id,
            'created_at' => is_null($this->created_at) ? null : Carbon::parse($this->created_at)->toDateTimeString(),
            'updated_at' => $this->updated_at,
        ];
    }
}
