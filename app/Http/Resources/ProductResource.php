<?php

namespace App\Http\Resources;

use App\Models\Product;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $product = $this;
        $views = explode(",", trim($product->views));

        return [
            'id' => $this->id,
            'name' => $this->name,
            'shop' => new ShopResource($product->shop),
            'category' => new SubCategoryResource($this->category),
            'user' => new UserResource($this->user),
            'description' => $this->description,
            'unit_price' => $this->unit_price,
            'status' => $this->status,
            'quantity' => $this->quantity,
            'is_service' => $this->service,
            'featured_image' => $this->getFeaturedImage(),
            'views' => count($views), 
            'reviews' => $this->reviews()->count(),
            'tags' => $this->tags ?? '',
            'slug' => $this->slug,
            'images' => $this->images->map(function ($image) {
                return [
                    'id' => $image->id,
                    'url' => $image->getImage()
                ];
            }),
        ];
    }
}
