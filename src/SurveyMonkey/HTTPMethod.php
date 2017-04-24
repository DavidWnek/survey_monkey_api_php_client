<?php

namespace davidwnek\SurveyMonkey;


class HTTPMethod
{
    const HEAD = 'head';
    const OPTIONS = 'options';
    const GET = 'get';
    const POST = 'post';
    const PATCH = 'patch';
    const PUT = 'put';
    const DELETE = 'delete';

    /**
     * @return array
     */
    static public function getAllMethods()
    {
        return array(self::HEAD, self::OPTIONS, self::GET, self::POST, self::PATCH, self::PUT, self::DELETE);
    }
}