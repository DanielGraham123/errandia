<?php

namespace App\Services;

use App\Repositories\UserRepository;
use \Illuminate\Support\Facades\Http;
use App\Repositories\UserOTPRepository;
use App\Models\User;
use Carbon\Carbon;
use Nette\Utils\Random;
use Ramsey\Uuid\Uuid;

class UserService{

    private $userRepository;
    private $validationService;
    protected $userOtpRepository;
    protected $smsService;

    public function __construct(UserRepository $userRepository, ValidationService $validationService, UserOTPRepository $userOtpRepository, SMSService  $smsService){
        $this->userRepository = $userRepository;
        $this->validationService = $validationService;
        $this->userOtpRepository = $userOtpRepository;
        $this->smsService = $smsService;
    }

    public function getAll($size = null)
    {
        # code...
        return $this->userRepository->get($size);
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

    public function update($id, $data)
    {
        # code...
        $validationRules = [];
        $this->validationService->validate($data, $data);
        if(empty($data))
            throw new \Exception("No data provided for update");
        return $this->userRepository->update($id, $data);
    }

    public function delete($id, $user_id)
    {
        # code...
        // can only be deleted by super admin or account owner
        return $this->userRepository->delete($id);
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