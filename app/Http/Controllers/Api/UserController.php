<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{

    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    //
    public function update(Request $request)
    {
        $user = $request->user('api');
        $rules = [
            'field_name' => ['required', Rule::in(['name', 'whatsapp_number'])],
            'field_value' => 'required',
        ];

        $this->validate($request->all(), $rules);
        if(!empty($this->validations_errors)) {
            return $this->build_response(response(), 'failed to update', 400);
        }

        try {
            $this->userService->update($user->id, $request->get('field_name'), $request->get('field_value'));
            return $this->build_response(response(), 'successfully updated');
        } catch(\Exception $e) {
            logger()->error($e->getMessage());
            return $this->build_response(response(), 'failed  to update this field', 400);
        }
    }

    public function userImageUpload(Request $request)
    {
        try {
            $user = $request->user('api');
            $file = $request->file('image');
            $image_path = $this->userService->updateProfileImage($user->id, $file);

            return $this->build_response(
                response(),
                'Profile image updated',
                200,
                ['image_path' => $image_path]
            );
        } catch (\Throwable $e) {
            logger()->error($e->getMessage());
            return $this->build_response(response(), 'failed to upload image', 400);
        }
    }
}
