<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class HumanitarianAidHistoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'index' => $this->index,
            'full_name' => $this->full_name,

            't_name' => $this->t_name,
            'f_name' => $this->f_name,
            's_name' => $this->s_name,
            'has_children' => $this->has_children ?? false,
            'children' => $this->children,
            'types' => $this->types,
            'count' => $this->count,


            'passport_issue_at' => $this->passport_issue_at,

            'passport' => $this->passport,
            'city' => $this->city,
            'address' => $this->address,
            'issue_date_history' => $this->issue_date_history,

            'description' => $this->description,
            'issue_at' => is_null($this->issue_at) ? null : Carbon::parse($this->issue_at)->toDateTimeString(),
            'deleted_at' => $this->deleted_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
