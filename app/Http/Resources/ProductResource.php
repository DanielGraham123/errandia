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
        $shop_info = $this->shop->info;
        $images = collect($product->images)->map(function ($item) {
            return [
                'id' => $item->id,
                'url' => $item->getImage()
            ];
        })->toArray();
        $views = explode(",", trim($product->views));

        return [
            'id' => $this->id,
            'name' => $this->name,
            'shop' => new ShopResource($product->shop),
            'category' => new CategoryResource($this->category),
            'description' => $this->description,
            'unit_price' => $this->unit_price,
            'status' => $this->status,
            'quantity' => $this->quantity,
            'is_service' => $this->service,
            'featured_image' => $this->getFeaturedImage(),
            // 'is_viewed' => in_array(auth('api')->user()->id, $views),
            'views' => count($views), 
            'reviews' => $this->reviews()->count(),
            'tags' => $this->tags ?? '',
            'images' => $images
        ];
    }
}
