<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\UserDevice;
use App\Notifications\UserNotification;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UserController extends Controller
{

    protected UserService $userService;

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
            $user = $this->userService->update($user->id, $request->get('field_name'), $request->get('field_value'));
            return $this->build_response(response(), 'successfully updated', 200, [
                'user' => new UserResource($user)
            ]);
        } catch(\Exception $e) {
            logger()->error($e->getMessage());
            return $this->build_response(response(), 'failed  to update this field', 400);
        }
    }

    public function userImageUpload(Request $request)
    {
        try {
            $user = $request->user('api');
            $image_path = $this->userService->update_user_profile_image($user->id, $request);
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

    public function show(Request $request)
    {
        return $this->build_success_response(
            response(),
            'user details loaded',
            [
                'item' => new UserResource(Auth::user())
            ]
        );
    }
    public function delete(Request $request)
    {
        $this->userService->delete_account($request, Auth::user());
        return $this->build_success_response(
            response(),
            'account successfully deleted'
        );
    }

    public function notify(Request $request)
    {
        try {
            $user = Auth::user();
            $userDevice =  UserDevice::where('user_id', $user->id)->first();

            if($userDevice) {
                $page = $request->get('page')?? 'other';
                switch ($page) {
                    case 'notification':
                        $user_notification = new UserNotification('Errandia', 'You have new message', 'notification', array('id' => "1", 'title' => ''));
                        break;
                    case 'errand':
                        $user_notification = new UserNotification('Errandia', 'A user created an errand which matches with your offers', 'received_errands');
                        break;
                    default:
                        $user_notification = new UserNotification('Errandia', 'Your subscription is now activated');
                }

                $userDevice->notify($user_notification);
                return $this->build_success_response(response(), 'notification sent');
            } else {
                logger()->error('Device not found');
                return $this->build_response(response(), 'failed  to send push notification', 400);
            }
        } catch (\Exception $e) {
            logger()->error($e->getMessage());
            return $this->build_response(response(), 'failed  to send push notification', 400);
        }
    }
}
