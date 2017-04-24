<?php

namespace davidwnek\SurveyMonkey\Service;

use davidwnek\SurveyMonkey\HTTPMethod;
use davidwnek\SurveyMonkey\Model\SurveyResponse;

class SurveyResponseService extends ClientService
{
    public function getResponseDetails($survey, $response)
    {
        $response = $this->client->run(sprintf('/surveys/%s/responses/%s/details', $survey, $response), HTTPMethod::GET);

        if($response->isError()) {
            return $response;
        }

        return new SurveyResponse($this->getClient(), $response->getResponse()->getBody()->__toString());
    }
}