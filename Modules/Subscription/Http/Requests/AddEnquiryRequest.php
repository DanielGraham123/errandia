<?php

namespace Modules\Subscription\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddEnquiryRequest extends FormRequest
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
        return ['caption' => 'required','sub_category'=>'required'];
    }

    /*
     * @Author:Dieudonne Dengun
     */
	
	public function getProductEnquiryImages()
    {
        $counter = $this->input('counter');
       	
		$data = [];
        for ($i = 1; $i <= $counter; $i++) {
            $name = 'previewimage-' . $i;
            $element = $this->file($name);
			
            if ($this->hasFile($name)) {
                array_push($data, [$name => $element]);
            }
        }
        return $data;
    }
}
