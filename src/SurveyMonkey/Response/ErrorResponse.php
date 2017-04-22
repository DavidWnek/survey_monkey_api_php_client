<?php

namespace davidwnek\SurveyMonkey\Response;


class ErrorResponse extends Response
{
    /**
     * Response constructor.
     * @param \GuzzleHttp\Psr7\Response $response
     */
    public function __construct(\GuzzleHttp\Psr7\Response $response)
    {
        parent::__construct($response);
        $this->isError = true;
    }
}