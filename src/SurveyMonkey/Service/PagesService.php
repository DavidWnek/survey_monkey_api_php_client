<?php

namespace davidwnek\SurveyMonkey\Service;

use davidwnek\SurveyMonkey\HTTPMethod;
use davidwnek\SurveyMonkey\Model\Page;
use davidwnek\SurveyMonkey\Model\Survey;
use davidwnek\SurveyMonkey\Response\ListResponse;

class PagesService extends ClientService
{
    const RESULTS_PER_PAGE = 25;

    /**
     * @param int $survey
     * @param int $page
     * @param int $resultsPerPage
     * @return ListResponse
     */
    public function getSurveyPages($survey, $page = 1, $resultsPerPage = self::RESULTS_PER_PAGE)
    {
        $params = array(
            'page' => $page,
            'per_page' => $resultsPerPage,
        );

        $response = $this->client->run(sprintf('/surveys/%s/pages', $survey), HTTPMethod::GET, $params);

        if($response->isError()) {
            return $response;
        }

        return new ListResponse($response->getResponse(), $this->getClient(), Page::class);
    }
}