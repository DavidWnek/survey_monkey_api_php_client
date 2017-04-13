<?php

namespace davidwnek\SurveyMonkey;


class Token
{
    /**
     * @var string
     */
    private $accessToken;

    /**
     * Token constructor.
     * @param string $accessToken
     */
    public function __construct($accessToken)
    {
        $this->accessToken = $accessToken;
    }

    /**
     * @return string
     */
    public function getAccessToken()
    {
        return $this->accessToken;
    }
}