<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SubscriptionResource extends JsonResource
{
    public function toArray($request)
    {
        $plan = $this->plan;
        return [
            'id' => $this->id,
            'description'=>$plan['description'],
            'amount'=>$plan['unit_price'],
            'expired_at' => $this->expired_at,
            'status'=>$this->status
        ];
    }
}
