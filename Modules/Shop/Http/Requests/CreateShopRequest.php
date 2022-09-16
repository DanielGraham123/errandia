<?php

namespace Modules\Shop\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateShopRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return ['supplier_name' => 'required', 'email' => 'required', 'password' => 'required|confirmed', 'shop_name' => 'required',
            'description', 'category' => 'required|not_in:none', 'website'=>'required',
            'town' => 'required', 'address' => 'required',
            'tel' => 'required', 'shop_image' => "required|max:3000|mimes:jpg,jpeg,png"];
    }

    public function getShopData()
    {
        return ['name' => $this->input('shop_name'),
            'description' => $this->input('description'),
            'category_id' => $this->input('category'),
            'image_path' => $this->file('shop_image')
        ];
    }

    public function getShopContactData()
    {
        return ['street_id' => $this->input('street'), 'tel' => $this->input('tel'), 'address' => $this->input('address'),
            'website_link' => $this->input('website'), 'facebook_link' => $this->input('facebook_link'), 'whatsapp_number' => $this->input('whatsapp')
        ];
    }

    public function getShopUserData()
    {
        return ['name' => $this->input('supplier_name'), 'email' => $this->input('email'), 'tel' => $this->input('tel'),
            'password' => bcrypt($this->input('password'))];
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
