<?php

namespace App\Services;

use App\Repositories\UserRepository;
use \Illuminate\Support\Facades\Http;
use App\Mail\OtpMailer;
use App\Models\UserOTP;
use App\Repositories\UserOTPRepository;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Mockery\Exception;
use Nette\Utils\Random;
use Ramsey\Uuid\Uuid;

class UserService{

    private $userRepository;
    private $validationService;
    protected $userOtpRepository;
    protected $smsService;

    public function __construct(UserRepository $userRepository,
                                ValidationService $validationService,
                                UserOTPRepository $userOtpRepository, SMSService  $smsService){
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

    public function update($id, $field_name, $value)
    {
        $this->userRepository->updatePartially($id, $field_name, $value);
    }

    public function updateProfileImage($user_id, $file)
    {
        # code...
        if($file == null){
            throw new \Exception("Empty file contents.");
        }

        $fname = 'profile_'.random_int(1000000, 9999999).'_'.time().'.'.$file->getClientOriginalExtension();
        $file->move(public_path('uploads/user_photos'), $fname);
        $path_name = $fname;
        logger()->info("File path : " . $path_name);
        $this->userRepository->updatePartially($user_id, 'phone', $path_name);
        return $path_name;
    }

    public function delete($id, $user_id)
    {
        # code...
        // can only be deleted by super admin or account owner
        return $this->userRepository->delete($id);
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

}