<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AnnouncementResource extends JsonResource
{

    public function toArray($request){
        return [
            'title' => $this->title,
            'message' => $this->message,
            'created_at' => $this->created_at,
            'read' => $this->id == $this->announcement_id
        ];
    }
}