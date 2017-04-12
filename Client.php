<?php

namespace Caxy\SurveyMonkey;


class Client
{
    public static $SM_STATUS_CODES = array(
        0 => "Success",
        1 => "Not Authenticated",
        2 => "Invalid User Credentials",
        3 => "Invalid Request",
        4 => "Unknown User",
        5 => "System Error",
        6 => "Plan Limit Exceeded"
    );

    /**
     * Explain Survey Monkey status code
     * @param integer $code Status code
     * @return string Definition
     */
    public static function explainStatusCode($code){
        return self::$SM_STATUS_CODES[$code];
    }

    const API_VERSION = 'v3';

    /**
     * @var string
     */
    private $clientId;

    /**
     * @var string
     */
    private $secret;

    /**
     * Client constructor.
     * @param string $clientId
     * @param string $secret
     * @param array  $scopes
     *
     * @throws SurveyMonkeyException
     */
    public function __construct($clientId, $secret, array $scopes)
    {
        if(empty($clientId)) {
            throw new SurveyMonkeyException('Missing Client ID');
        }

        if(empty($secret)) {
            throw new SurveyMonkeyException('Missing Secret');
        }

        $this->clientId = $clientId;
        $this->secret = $secret;
    }
}