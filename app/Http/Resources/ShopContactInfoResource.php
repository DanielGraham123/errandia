<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ShopContactInfoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $street = $this->street;
        return [
            'shop_id'=>$this->shop_id, 
            'street'=>[
                'name'=>$street->name,
                'town_id'=>$street->town_id
            ],
            'location'=>$this->location(),
            'phone'=>$this->phone, 
            'phone_country_code'=>$this->phone_country_code, 
            'whatsapp'=>$this->whatsapp, 
            'whatsapp_country_code'=>$this->whatsapp_country_code, 
            'address'=>$this->address, 
            'facebook'=>$this->facebook, 
            'instagram'=>$this->instagram, 
            'website'=>$this->website, 
            'email'=>$this->email
        ];
    }
}
