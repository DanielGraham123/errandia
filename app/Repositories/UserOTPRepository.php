<?php

namespace App\Repositories;

use App\Models\UserOTP;

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
        return UserOTP::wheer([
            'uuid' =>  $uuid,
            'code' =>  $code,
            'verified' => false
        ])->first();
    }

    public function update($id)
    {
        $model = UserOTP::findOrFail($id);
        $model->update(['verified' => true]);
    }
}