<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ShopManagerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'shop_id'=>$this->shop_id,
            'is_owner'=>$this->is_owner,
            'status'=>$this->status,
            'manager'=>(new UserResource($this->user))->resolve(),
        ];
    }
}
