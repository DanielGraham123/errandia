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
            'gender' => $this->profile->gender == 'M' ? 'Male' : 'Female',
            'profile' => $this->getProfileUrl(),
            'street' => $this->profile->street->name,
            'town' => $this->profile->street->town->name,
            'region' => $this->profile->street->town->region->name,
            'place_of_birth' => $this->profile->pob ?? '',
            'date_of_birth' => $this->profile->dob ?? '',
        ];
    }
}
