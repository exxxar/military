<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class PeopleResource extends JsonResource
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
            'uuid' => $this->uuid,
            'fname' => $this->fname,
            'sname' => $this->sname,
            'tname' => $this->tname,
            'birth' => $this->birth,
            'age_from' => $this->age_from,
            'age_to' => $this->age_to,
            'sex' => $this->sex,
            'photos' => $this->photos,
            'phones' => $this->phone,
            'user_id' => $this->user_id,
            'people_id' => $this->people_id,
            'city' => $this->city,
            'region' => $this->region,
            'address' => $this->address,
            'story' => $this->story,
            'description' => $this->description,
            'status' => $this->status,
            'for' => $this->for,
            'searched_from' => $this->searched_from,


            "phoenix_num"=> $this->phoenix_num,
            "email"=> $this->email,
            "type"=> $this->type,
            "passport"=> $this->passport,
            "evacuation_place"=> $this->evacuation_place,

            'is_active' => $this->is_active,
            'deleted_at' => $this->deleted_at,
            'created_at' =>Carbon::parse($this->created_at)->toDateTimeString(),
            'updated_at' => $this->updated_at,
        ];
    }
}
