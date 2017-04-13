<?php

namespace davidwnek\SurveyMonkey\TokenStorage;


use davidwnek\SurveyMonkey\Token;

class SessionTokenStorage implements TokenStorageInterface
{
    const SESSION_KEY = 'davidwnek_session_token_storage';

    /**
     * SessionTokenStorage constructor.
     */
    public function __construct()
    {
        session_start();
    }

    /**
     * @param Token $token
     */
    public function storeToken(Token $token)
    {
        $_SESSION[self::SESSION_KEY] = $token->getAccessToken();
    }

    /**
     * @return Token|null
     */
    public function getToken()
    {
        if($this->hasToken()) {
            return new Token($_SESSION[self::SESSION_KEY]);
        }

        return null;
    }

    /**
     * @return bool
     */
    public function hasToken()
    {
        return isset($_SESSION[self::SESSION_KEY]);
    }
}