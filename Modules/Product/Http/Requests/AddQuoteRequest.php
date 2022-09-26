<?php

namespace Modules\Product\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddQuoteRequest extends FormRequest
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
        return ['Title' => 'required', 'Description' => 'required'];
    }

    /*
     * @Author:Dieudonne Dengun
     */
	public function getProductQuoteImages()
    {
        $counter = $this->input('QuoteImageCounter');
		$data = [];
        for ($i = 1; $i <= $counter; $i++) {
            $name = 'preview-' . $i;
            $element = $this->file($name);
            if ($this->hasFile($name)) {
                array_push($data, [$name => $element]);
            }
        }
        return $data;
    }
}
