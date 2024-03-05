<?php

namespace App\Repositories;

use App\Models\ShopOTP;
use Illuminate\Support\Carbon;

class ShopOTPRepository
{
    public function __construct()
    {
    }

    public function save($shop_id, $uuid, $code, $expired_date)
    {
        return ShopOTP::create([
            'shop_id' => $shop_id,
            'uuid' => $uuid,
            'code' => $code,
            'expired_date' => $expired_date,
        ]);
    }

    public function find($uuid, $code)
    {
        return ShopOTP::where([
            'uuid' =>  $uuid,
            'code' =>  $code,
            'verified' => 0,
        ])
            ->where('expired_date', '>', Carbon::now())
            ->first();
    }

    public function update($shop_otp)
    {
        $shop_otp->verified = true;
        $shop_otp->save();
    }

    public function numberOfOtpRequested($shop_id)
    {
        return ShopOTP::where(
            [
                'shop_id' =>  $shop_id,
                'created_at' =>  Carbon::today()
            ]
        )->count();
    }

}