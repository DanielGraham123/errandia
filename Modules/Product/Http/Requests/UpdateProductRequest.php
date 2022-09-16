<?php

namespace Modules\Product\Http\Requests;

use App\Dtos\ProductDTO;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
        $rules = ['name' => 'required', 'description' => 'required',
            'quantity' => 'required|numeric', 'price' => 'required|numeric',
            'sub_category' => 'required|not_in:none|numeric', 'currency' => 'required|not_in:none'];
        if ($this->hasFile('product-1')) {
            $rules['product-1'] = 'required|max:3000|mimes:jpg,jpeg,png';
        }
        return $rules;
    }

    /*
     * @Author:Dieudonne Dengun
     *
     */
    public function getProductDTO()
    {
        $product_featured_image = $this->hasFile("product-1") ? $this->file('product-1') : "";
        return ['name' => $this->input('name'), 'summary' => "", 'sub_category_id' => intval($this->input('sub_category')), 'description' => $this->input('description'), 'currency_id' => intval($this->input('currency')),
            'quantity' => $this->input('quantity'), 'unit_price' => $this->input('price'), 'featured_image_path' => $product_featured_image];
    }

    //get product extra images
    public function getExtraProductImages()
    {
        $counter = $this->input('counter');
        $data = [];
        if ($counter == 0) return $data;
        $counter = 5;
        for ($i = 1; $i <= $counter; $i++) {
            $name = 'product-' . $i;
            $element = $this->file($name);
            if ($this->hasFile($name)) {
                array_push($data, [$name => $element]);
            }
        }
        return $data;
    }
}
