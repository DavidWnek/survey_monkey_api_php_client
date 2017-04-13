<?php

namespace davidwnek\SurveyMonkey;


class HTTPMethod
{
    const HEAD = 'HEAD';
    const OPTIONS = 'OPTIONS';
    const GET = 'GET';
    const POST = 'POST';

    /**
     * @return array
     */
    static public function getAllMethods()
    {
        return array(self::HEAD, self::OPTIONS, self::GET, self::POST);
    }
}