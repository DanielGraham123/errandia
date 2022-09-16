<?php

namespace Modules\User\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use \Carbon\Carbon;

class UpdateCustomerProfileRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return ['gender' => 'required', 'pob' => 'required', 'dob' => 'required'
            , 'street' => 'required|not_in:none', 'category' => 'required|not_in:none'];
    }

    public function getUserProfileInfo()
    {
        return ['gender' => $this->input('gender'),
            'street_id' => $this->input('street'),
            'pob' => $this->input('pob'),
            'dob' => Carbon::parse($this->input('dob'))->format('Y-m-d'),
//            'dob' =>$this->input('dob'),
            'categories_interest' => implode('#', $this->input('category')),
        ];
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
