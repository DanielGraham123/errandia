<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email ?? '',
            'phone' => $this->phone,
            'address' => $this->address ?? '',
            'gender' =>  $this->profile ? ($this->profile->gender ?? '') : '',
            'profile' => $this->getProfileUrl(),
            'street' => $this->street ? $this->street->name : '',
            'town' => $this->street ? $this->street->town->name: '',
            'region' => $this->street ? $this->street->town->region->name : '',
            'place_of_birth' => $this->profile ? $this->profile->pob : '',
            'date_of_birth' => $this->profile ? $this->profile->dob : '',
        ];
    }
}
