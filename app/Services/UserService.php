<?php

namespace App\Services;

use App\Jobs\UserDeletedJob;
use App\Repositories\UserDeviceRepository;
use App\Repositories\UserRepository;
use App\Mail\OtpMailer;

use App\Repositories\UserOTPRepository;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Laravel\Passport\RefreshTokenRepository;
use Laravel\Passport\TokenRepository;
use Mockery\Exception;
use Nette\Utils\Random;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Carbon;

class UserService{

    private UserRepository $userRepository;
    private ValidationService$validationService;
    protected UserOTPRepository $userOtpRepository;
    protected SMSService $smsService;

    public function __construct(UserRepository $userRepository,
                                ValidationService $validationService,
                                UserOTPRepository $userOtpRepository,
                                SMSService  $smsService
    ){
        $this->userRepository = $userRepository;
        $this->validationService = $validationService;
        $this->userOtpRepository = $userOtpRepository;
        $this->smsService = $smsService;
    }

    public function getAll($size = null)
    {
        # code...
        return $this->userRepository->findAll($size);
    }

    public function getById($id)
    {
        # code...
        return $this->userRepository->getById($id);
    }

    public function save($data)
    {
        # code...
        $validationRules = [];
        $this->validationService->validate($data, $validationRules);
        return $this->userRepository->store($data);
    }

    public function update($id, $field_name, $value)
    {
        return $this->userRepository->updatePartially($id, $field_name, $value);
    }

    public function update_user_profile_image($user_id, $request)
    {
        MediaService::has_file($request, 'image');
        $user = $this->userRepository->getById($user_id);
        if(!empty($user->photo)) {
            MediaService::delete_media($user->photo);
            logger()->info('previous image file deleted : ' . $user->photo);
        }

        $path_name = MediaService::upload_media($request, 'image', 'user_photos');
        $this->userRepository->updatePartially($user_id, 'photo', $path_name);
        return $path_name;
    }

    public function delete($id, $user_id)
    {
        # code...
        // can only be deleted by super admin or account owner
        return $this->userRepository->delete($id);
    }

    public function load_user_by($identifier)
    {
        return User::whereRaw('(phone = ? OR email = ?) AND deleted = 0', [$identifier, $identifier])
            ->first();
    }

    public function findAndSendOTP($identifier)
    {
        // Todo to implement it in user repository clqss
        $user = $this->load_user_by($identifier);

        if($user) {
            $user_otp = $this->userOtpRepository->save(
                $user->id,
                (string) Uuid::uuid4(),
                Random::generate(4, '0-9'),
                Carbon::now()->addMinutes(120)
            );
            $num_otp_sent = $this->userOtpRepository->numberOfOtpRequested($user->id);

            $sent = false;
            if ($user->email == $identifier || $num_otp_sent > 3) {
                $channel = $user->email;
                $data['code'] =  $user_otp->code;
                $data['email'] =  $user->email;

                try {
                    Mail::to($user->email)->send(new OtpMailer($data));
                    $sent = true;
                } catch (Exception $e) {
                    logger()->error($e->getMessage());
                }
            } else {
                $channel = $user->phone;
                $sent =  $this->smsService->send($user->phone,
                    'Use this verification code : ' . $user_otp->code .  ' to complete the authentication'
                );
            }


            if ($sent) {
                logger()->info('A user with identifier : '. $channel.' requested an otp code for authentication');
                return ['user' => $user, 'channel' => $channel, 'uuid' => $user_otp->uuid];
            }

            return  null;
        }

        return null;
    }

    /**
     * Validate the OTP code and return the user object
     *
     * @param $uuid
     * @param $code
     * @return User|null
     */
    public function checkOTP($uuid, $code)
    {
        logger()->info("check otp " . $code.  " with uuid : " . $uuid);

        $user_otp = $this->userOtpRepository->find($uuid, $code);
        if($user_otp) {
            $this->userOtpRepository->update($user_otp);
            return $user_otp->user();
        }

        return null;
    }

    public function save_device_info($data): void
    {
        if(!empty($data['device_uuid']) && !empty($data['push_token'])) {
            UserDeviceRepository::save($data);
        }
    }

    public function logout(Request $request)
    {
        $token_id = $request->user()->token()->id;
        $tokenRepository = app(TokenRepository::class);
        $refreshTokenRepository = app(RefreshTokenRepository::class);
        $tokenRepository->revokeAccessToken($token_id);
        $refreshTokenRepository->revokeRefreshTokensByAccessTokenId($token_id);
        logger()->info("user auth token deleted");
    }

    public function delete_account(Request $request, $user): void
    {
        $user->deleted = true;
        $user->save();
        logger()->info('User record set as deleted');

        $this->logout($request);
        logger()->info('Your account and data are being deleted');

        // send a background job to deleted all the user data
        UserDeletedJob::dispatch($user)->delay(Carbon::now()->addSeconds(1));
    }

}