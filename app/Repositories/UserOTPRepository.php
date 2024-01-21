<?php

namespace App\Repositories;

use App\Models\UserOTP;
use Carbon\Carbon;

class UserOTPRepository
{
    public function __construct()
    {
    }

    public function save($user_id, $uuid, $code, $expired_date)
    {
        return UserOTP::create([
            'user_id' => $user_id,
            'uuid' => $uuid,
            'code' => $code,
            'expired_date' => $expired_date,
        ]);
    }

    public function find($uuid, $code)
    {
        return UserOTP::where([
            'uuid' =>  $uuid,
            'code' =>  $code,
            'verified' => 0,
        ])
            ->where('expired_date', '>', Carbon::now())
            ->first();
    }

    public function update($user_otp)
    {
        $user_otp->verified = true;
        $user_otp->save();
    }
}