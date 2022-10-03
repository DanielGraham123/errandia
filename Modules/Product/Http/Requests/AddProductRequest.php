<?php

namespace Modules\Product\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        dd($this->input('name'));
        return ['name' => 'required', 'description' => 'required',
            'quantity' => 'required|numeric', 'price' => 'required|numeric',
            'sub_category' => 'required|not_in:none|numeric', 'currency' => 'required|not_in:none',
            'image' => 'required|array|min:0',
            "image.*"  => "required|string|distinct|min:0",

        ];
    }

    /*
     * @Author:Dieudonne Dengun
     */
    public function getProductDTO()
    {
        return ['name' => $this->input('name'), 'summary' =>"", 'sub_category_id' => $this->input('sub_category'), 'description' => $this->input('description'), 'currency_id' => intval($this->input('currency')),
            'quantity' => $this->input('quantity'), 'unit_price' => $this->input('price'), 'featured_image_path' => "default.jpg"];
    }

    public function getExtraProductImages()
    {
        $counter = $this->input('counter');
        $data = [];
        for ($i = 2; $i <= $counter; $i++) {
            $name = 'product-' . $i;
            $element = $this->file($name);
            if ($this->hasFile($name)) {
                array_push($data, [$name => $element]);
            }
        }
        return $data;
    }
}
