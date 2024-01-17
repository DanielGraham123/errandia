<?php

namespace App\Http\Resources;

use App\Models\Street;
use Illuminate\Http\Resources\Json\JsonResource;

class ErrandResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $errand = $this;
        $user = $errand->user;
        $images = collect($errand->images)->map(function ($item) {
            return [
                'id' => $item->id,
                'url' => $item->getImage()
            ];
        })->toArray();
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'slug' =>  $this->slug,
            'read_status' => $this->read_status,
            'user' => new UserResource($user),
            'categories' => $this->subCategories(),
            'images' => $images,
            'created_at' => $this->created_at,
            'when' => $this->created_at->diffForHumans(),
            'street' => $this->street ? $this->street->name : '',
            'town' => $this->street ? $this->street->town->name : '',
            'region' => $this->street ? $this->street->town->region->name: ''
        ];
    }
}
