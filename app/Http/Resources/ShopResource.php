<?php

namespace App\Http\Resources;

use App\Models\Shop;
use Illuminate\Http\Resources\Json\JsonResource;

class ShopResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $shop = $this;
        $shop_info = $this->info;
        $shop_registration = $this->registration;

        $parentShopDetails = null;
        if ($this->parent_id) {
            $parentShop = Shop::find($this->parent_id);
            if ($parentShop) {
                $parentShopDetails = new ShopResource($parentShop);
            }
        }
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'user' => new UserResource($shop->user),
            'category' => new CategoryResource($shop->category),
            'parent' => new ShopResource($shop->parent),
            'image' => $this->image_path,
            'status' => $this->status,
            'is_branch' => $this->is_branch,
            'slug' => $this->slug,
//            'categories' => $this->subCategories,
            'slogan' => $this->slogan ?? '',
            'street' => $shop_info->street ? $shop_info->street->name : '',
            'phone' => $shop_info->phone ?? '',
            'whatsapp' => $shop_info->whatsapp ?? '',
            'address' => $shop_info->address ?? '',
            'facebook' => $shop_info->facebook ?? '',
            'instagram' => $shop_info->instagram ?? '',
            'website' => $shop_info->website ?? '',
            'email' => $shop_info->email ?? '',
            'registration_name' => $shop_registration ? $shop_registration->registration_name : '',
            'registration_number' => $shop_registration ? $shop_registration->registration_number : '',
            'tax_payer_number' => $shop_registration ? $shop_registration->tax_payer_number : '',
            'tax_payer_doc_path' => $shop_registration ? $shop_registration->tax_payer_doc_path : '',
            'years_of_experience' => $shop_registration ? $shop_registration->years_of_experience : '',
        ]; 
    }
}
