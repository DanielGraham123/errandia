<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ShopSubscriptionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $shop = $this->shop;
        return [
            'id'=>$this->id,
            'shop_id'=>$this->shop_id, 
            'shop'=>(new ShopResource($shop))->resolve(),
            'subscription'=>(new SubscriptionPlanResource($this->subscription))->resolve(), 
            'subscription_date'=>$this->$this->subscription_date, 
            'expiration_date'=>$this->expiration_date, 
            'status'=>$this->status
        ];
    }
}
