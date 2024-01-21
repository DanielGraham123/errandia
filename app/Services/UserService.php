<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\UserOTPRepository;
use Carbon\Carbon;
use Nette\Utils\Random;
use Ramsey\Uuid\Uuid;

class UserService {
    protected $userOtpRepository;
    protected $smsService;
    public function __construct(UserOTPRepository $userOtpRepository, SMSService  $smsService)
    {
        $this->userOtpRepository = $userOtpRepository;
        $this->smsService = $smsService;
    }


    public function findAndSendOTP($phone_number)
    {
        $user = User::where('phone', $phone_number)->first();

        if($user) {
            $user_otp = $this->userOtpRepository->save(
                $user->id,
                (string) Uuid::uuid4(),
                Random::generate(4, '0-9'),
                Carbon::now()->addMinutes(120)
            );

            $sent =  $this->smsService->send($user->phone,
                'Use this verification code : ' . $user_otp->code .  ' to complete the authentication'
            );

            if ($sent) {
                logger()->info('A user with phone number : '. $phone_number.' requested an otp code for authentication');
                return $user_otp;
            }

            return null;
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


}