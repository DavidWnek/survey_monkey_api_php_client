<?php

namespace davidwnek\SurveyMonkey\TokenStorage;

use davidwnek\SurveyMonkey\Token;
use Symfony\Component\HttpFoundation\Session\Session;

class SymfonySessionStorage implements TokenStorageInterface
{
    const SESSION_KEY = 'davidwnek_session_token_storage';

    /**
     * @var Session
     */
    private $session;

    /**
     * @param Session $session
     */
    public function setSession(Session $session)
    {
        $this->session = $session;
    }

    /**
     * @param Token $token
     */
    public function storeToken(Token $token)
    {
        $this->session->set(self::SESSION_KEY, $token->getAccessToken());
    }

    /**
     * @return Token|null
     */
    public function getToken()
    {
        if($this->hasToken()) {
            return new Token($this->session->get(self::SESSION_KEY));
        }

        return null;
    }

    /**
     * @return bool
     */
    public function hasToken()
    {
        return $this->session->has(self::SESSION_KEY);
    }
}