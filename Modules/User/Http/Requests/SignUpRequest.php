<?php

namespace Modules\User\Http\Requests;

use App\Dtos\UserDTO;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class SignUpRequest extends FormRequest
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
        return ['email' => 'required|email', 'name' => 'required',
            'phone_number' => 'required', 'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required'];
    }

    public function getUserDTO()
    {
        return ['name' => ucfirst($this->input('name')), 'email' => $this->input('email'),
            'tel' => $this->input('phone_number'), 'password' => Hash::make($this->input('password'))];
    }
}
