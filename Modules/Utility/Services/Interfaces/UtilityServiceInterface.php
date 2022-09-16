<?php
/**
 * User: Dieudonnne Takougang
 * Date: 9/28/2020
 */

namespace Modules\Utility\Services\Interfaces;


interface UtilityServiceInterface
{
    public function addSessionData($key, $data);

    public function getSessionDataByKey($key);

    public function hasSessionValue($key);

    public function forgetSessionByKey($key);

    public function clearSession();

    public function getCurrentLoggedUser();

    public function getShopAddressByShopContactId($contactId);

    public function getCurrentUserType();

    public function getCurrentUserShop();

    public function sendSMS($message, $recipients);

}
