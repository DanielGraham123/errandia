<?php

namespace App\Http\Resources;

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
                'image_path' => $item->image
            ];
        })->toArray();

        $data = [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'slug' =>  $this->slug,
            'read_status' => $this->read_status,
            'status' => $this->status,
            'user' => new UserResource($user),
            'images' => $images,
            'created_at' => $this->created_at,
            'when' => $this->created_at->diffForHumans(),
        ];

        $data['region'] = [];
        if ($this->region){
            $data['region'] = [
                'id' => $this->region->id,
                'name' => $this->region->name,
            ];
        }

        $data['town'] = [];
        if ($this->town){
            $data['town'] = [
                'id' => $this->town->id,
                'name' => $this->town->name,
            ];
        }

        $data['street'] = [];
        if ($this->street){
            $data['street'] = [
                'id' => $this->street->id,
                'name' => $this->street->name,
            ];
        }

        $data['categories'] = [];
        foreach ($this->sub_categories() as $sub_category) {
            $data['categories'][] = [
                'id' => $sub_category->id,
                'name' => $sub_category->name,
            ];
        }

        return $data;
    }
}
