<?php

namespace App\Repositories;

use App\Models\UserDevice;

class UserDeviceRepository
{
    public static function save($data): void
    {
        $record = UserDevice::where("device_uuid", $data['device_uuid']);
        if($record) {
            $record->delete();
            logger()->info("previous record having ". $data['device_uuid'] . " has been deleted");
        }

        UserDevice::create($data);
        logger()->info("Record for device added ");
    }

    public static function getDevice($user_id)
    {
        return UserDevice::where('user_id', $user_id)->first();
    }
}