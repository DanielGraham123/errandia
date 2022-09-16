<?php

namespace Modules\ProductCategory\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
{
    public function rules()
    {
        $rules = [
            'name' => 'required',
            'description' => 'required',
        ];
        $this->hasFile('category_image') ? $rules['category_image'] = "required|mimes:jpg,bmp,png,jpeg" : $rules['image_path'] = "required";
        return $rules;
    }

    public function getCategoryData()
    {
        $image_path = $this->hasFile('category_image') ? $this->file('category_image') : "";
        return ['name' => $this->input('name'), 'description' => $this->input('description'),
            'image_path' => $image_path];
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
