<?php

use \Modules\Utility\Services\UtilityService;
use \Carbon\Carbon;

if (!function_exists('has_user_subscribed')) {
    function has_user_subscribed($shop_id, $user_id)
    {
        return UtilityService::hasUserSubscribedShop($shop_id, $user_id);
    }
}
if (!function_exists('convert_date_to_human')) {
    function convert_date_to_human($date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->diffForHumans();
    }
}
if (!function_exists('get_user_id')) {
    function get_user_id()
    {
        return UtilityService::getUserId();
    }
}
if (!function_exists('isMobile')) {
    function isMobile()
    {
        return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
    }
}
if (!function_exists('get_user_account_link')) {
    function get_user_account_link()
    {
        return UtilityService::getUserHomePage();
    }
}

