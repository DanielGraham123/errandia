<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class productCategoryResource extends JsonResource
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
            'item'=>new ProductResource($this->item()),
            'category'=> new CategoryResource($this->category())
        ];
    }
}
