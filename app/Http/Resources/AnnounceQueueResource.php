<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class AnnounceQueueResource extends JsonResource
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
            'title' => $this->title,
            'text' => $this->text,
            'images' => $this->images,
            'need_send_at' => is_null($this->need_send_at) ? null : Carbon::parse($this->need_send_at)->toDateTimeString(),
            'sent_at' => is_null($this->sent_at) ? null : Carbon::parse($this->sent_at)->toDateTimeString(),
            'sender_id' => $this->sender_id,
            'deleted_at' => $this->deleted_at,
        ];
    }
}
