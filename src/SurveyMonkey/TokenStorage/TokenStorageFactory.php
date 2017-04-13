<?php

namespace davidwnek\SurveyMonkey\TokenStorage;

use davidwnek\SurveyMonkey\SurveyMonkeyException;

class TokenStorageFactory
{
    static private $tokenStorage;

    /**
     * @param string $class
     * @return TokenStorageInterface
     * @throws SurveyMonkeyException
     */
    static public function createTokenStorage($class)
    {
        if(!in_array(TokenStorageInterface::class, class_implements($class))) {
            throw new SurveyMonkeyException('Token Storage does not implement TokenStorageInterface');
        }

        if(self::$tokenStorage === null) {
            self::$tokenStorage = new $class();
        }

        return self::$tokenStorage;
    }
}