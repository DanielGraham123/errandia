<?php

namespace Modules\Utility\Services\SMSAPI;


class SMSConfig
{
    private $username = "nishang";
    private $password = "Nish@237";
    private $messageType = "0";
    private $smsSenderName = "ERRANDIA"; //- Max Length of 11 if alphanumeric.
    private $smsApiBaseUrl = "https://api.rmlconnect.net/bulksms/bulksms?";

    public function __construct()
    {

    }

    /**
     * @return string
     */
    public function getSmsApiBaseUrl()
    {
        return $this->smsApiBaseUrl;
    }

    /**
     * @return string
     */
    public function getSmsSenderName()
    {
        return $this->smsSenderName;
    }

    /**
     * @return string
     */
    public function getMessageType()
    {
        return $this->messageType;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }
}
