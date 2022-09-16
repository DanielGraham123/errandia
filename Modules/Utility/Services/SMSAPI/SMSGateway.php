<?php
namespace Modules\Utility\Services\SMSAPI;

/*
 * @Author:Dieudonne Dengun
 * @Date: 27/10/2021
 * @Description: Handle sms message notification
 */

class SMSGateway
{
    private $smsConfig;
    private $message;
    private $recipients;
    private $requestUrl;

    public function __construct(SMSConfig $config)
    {
        $this->smsConfig = $config;
    }

    /**
     * @param mixed $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
        return $this;
    }

    /**
     * @param mixed $recipients
     */
    public function setRecipients($recipients)
    {
        $this->recipients = $recipients;
        return $this;
    }

    public function prepareSMSMessage()
    {
        //convert recipient array to string of comma separated numbers;

        $requestParams = array(
            'username' => $this->smsConfig->getUsername(),
            'password' => $this->smsConfig->getPassword(),
            'type' => $this->smsConfig->getMessageType(),
            'dlr' => "1",
            'destination' => $this->recipients,
            'source' => $this->smsConfig->getSmsSenderName(),
            'message' => $this->message
        );
        $urlEncodedParams = http_build_query($requestParams);
        $baseUrl = $this->smsConfig->getSmsApiBaseUrl();
        $this->requestUrl = $baseUrl . $urlEncodedParams;
        return $this;
    }

    public function sendMessage()
    {
        $requestHeaders = array();
        array_push($requestHeaders, "Content-Type: application/x-www-form-urlencoded");
        return $this->makeGetHttpCurlRequest($requestHeaders, $this->requestUrl);
    }

    //handle curl get request to a url
    public function makeGetHttpCurlRequest($header, $url)
    {
        //initiate curl connection
        $connection = curl_init($url);
        curl_setopt($connection, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($connection, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($connection, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($connection, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.1.2) Gecko/20090729 Firefox/3.5.2 GTB5');
        $curlResponse = curl_exec($connection);
        $curlResponseCode = curl_getinfo($connection, CURLINFO_HTTP_CODE);
        curl_close($connection);
        return (object)array('body' => $curlResponse, 'status' => $curlResponseCode);
    }
}


?>
