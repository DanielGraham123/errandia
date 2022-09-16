<?php

namespace Modules\ProductCategory\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCategoryRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'description' => 'required',
            "category_image" => "required|mimes:jpg,bmp,png,jpeg"
        ];
    }

    public function getCategoryData()
    {
        return ['name' => $this->input('name'), 'description' => $this->input('description'),
            'image_path' => $this->file('category_image')];
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
