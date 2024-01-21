<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReviewResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $images = collect($this->images)->map(function ($item) {
            return [
                'id' => $item->id,
                'url' => $item->getImage()
            ];
        })->toArray();
        
        return [
            'id' => $this->id,
            'user' => new UserResource($this->user),
            'product' => [
                'name' => $this->product->name,
                'description' => $this->product->description,
                'image' => $this->product->getFeaturedImage()
            ],
            'rating' => $this->rating,
            'review' => $this->review,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'when' => $this->created_at->diffForHumans(),
            'images' => $images
        ];
    }
}
