<?php

namespace App\Services;

use App\Mail\OtpMailer;
use App\Models\User;
use App\Models\UserOTP;
use App\Repositories\UserOTPRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
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


    public function findAndSendOTP($identifier)
    {
        // Todo to implement it in user repository clqss
        $user = User::where('phone', $identifier)
            ->orWhere('email', $identifier)
            ->first();

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
                Mail::to($user->email)->send(new OtpMailer($data));
                $sent = true;
            } else {
                $channel = $user->phone;
                $sent =  $this->smsService->send($user->phone,
                    'Use this verification code : ' . $user_otp->code .  ' to complete the authentication'
                );
            }


            if ($sent) {
                logger()->info('A user with identifier : '. $channel.' requested an otp code for authentication');
                return ['user' => $user, 'channel' => $channel];
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




}