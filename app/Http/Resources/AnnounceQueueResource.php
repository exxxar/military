<?php

namespace App\Http\Resources;

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
            'need_send_at' => $this->need_send_at,
            'sent_at' => $this->sent_at,
            'sender_id' => $this->sender_id,
            'deleted_at' => $this->deleted_at,
        ];
    }
}
