<?php

namespace Modules\Shop\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateShopRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = ['supplier_name' => 'required', 'shop_name' => 'required', 'description', 'category' => 'required|not_in:none',
        'town' => 'required', 'address' => 'required', 'tel' => 'required','website'=>'required'
        ];
        if ($this->hasFile('shop_image')) {
            $rules['shop_image'] = 'required|max:3000|mimes:jpg,jpeg,png';
        }
        return $rules;
    }

    public function getShopData()
    {
        $shop_image = $this->hasFile("shop_image") ? $this->file('shop_image') : "";
        return ['name' => $this->input('shop_name'), 'description' => $this->input('description'),
            'category_id' => $this->input('category'), 'image_path' => $shop_image
        ];
    }

    public function getShopContactData()
    {
        return ['street_id' => $this->input('street'), 'tel' => $this->input('tel'), 'address' => $this->input('address'),
            'website_link' => $this->input('website'), 'facebook_link' => $this->input('facebook_link'),
            'whatsapp_number' => $this->input('whatsapp')
        ];
    }

    public function getShopUserData()
    {
        return ['name' => $this->input('supplier_name'), 'tel' => $this->input('tel')];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
