<?php

namespace davidwnek\SurveyMonkey\Service;

use davidwnek\SurveyMonkey\HTTPMethod;
use davidwnek\SurveyMonkey\Model\SurveyResponse;
use davidwnek\SurveyMonkey\Response\ListResponse;

class SurveyResponseService extends ClientService
{
    public function getResponses($survey, $page = 1, $resultsPerPage = self::RESULTS_PER_PAGE)
    {
        $params = array(
            'page' => $page,
            'per_page' => $resultsPerPage,
        );

        $response = $this->client->run(sprintf('/surveys/%s/responses', $survey), HTTPMethod::GET, $params);

        if($response->isError()) {
            return $response;
        }

        return new ListResponse($response->getResponse(), $this->getClient(), SurveyResponse::class);
    }

    public function getResponse($survey, $response)
    {
        $response = $this->client->run(sprintf('/surveys/%s/responses/%s', $survey, $response), HTTPMethod::GET);

        if($response->isError()) {
            return $response;
        }

        return SurveyResponse::createFromString($this->getClient(), $response->getResponse()->getBody()->__toString());
    }

    public function getResponseDetails($survey, $response)
    {
        $response = $this->client->run(sprintf('/surveys/%s/responses/%s/details', $survey, $response), HTTPMethod::GET);

        if($response->isError()) {
            return $response;
        }

        return SurveyResponse::createFromString($this->getClient(), $response->getResponse()->getBody()->__toString());
    }
}