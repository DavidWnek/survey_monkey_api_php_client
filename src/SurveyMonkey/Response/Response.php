<?php

namespace davidwnek\SurveyMonkey\Response;

class Response
{
    protected $response;

    public function __construct(\GuzzleHttp\Psr7\Response $response)
    {
        $this->response = $response;
    }
}