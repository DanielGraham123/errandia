<?php

namespace Modules\User\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBusinessInfoRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return ['shop_description' => 'required', 'shop_address' => 'required', 'shop_contact' => 'required','website' => 'required'];
    }

    public function getBusinessInfo()
    {
        return ['description' => $this->input('shop_description'), 'image_path' => ''];
    }

    public function getBusinessContactInfo()
    {
        return ['address' => $this->input('shop_address'),
			'town_id' => $this->input('town'),
			'street_id' => $this->input('street'),
            'tel' => $this->input('shop_contact'),
            'website_link' => $this->input('website'),
            'facebook_link' => $this->input('facebook_link'),
            'instagram_link' => $this->input('instagram_link')];
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
