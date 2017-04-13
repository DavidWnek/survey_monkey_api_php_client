<?php

namespace davidwnek\SurveyMonkey\TokenStorage;

use davidwnek\SurveyMonkey\Token;

interface TokenStorageInterface
{
    public function storeToken(Token $token);

    public function getToken();

    public function hasToken();
}