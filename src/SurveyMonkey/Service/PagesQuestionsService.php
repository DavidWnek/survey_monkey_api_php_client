<?php

namespace davidwnek\SurveyMonkey\Service;

use davidwnek\SurveyMonkey\HTTPMethod;
use davidwnek\SurveyMonkey\Model\PageQuestion;
use davidwnek\SurveyMonkey\Model\Survey;
use davidwnek\SurveyMonkey\Response\ListResponse;

class PagesQuestionsService extends ClientService
{
    const RESULTS_PER_PAGE = 25;

    /**
     * @param int $survey
     * @param int $questionPage
     * @param int $page
     * @param int $resultsPerPage
     * @return ListResponse
     */
    public function getSurveyPagesQuestions($survey, $questionPage, $page = 1, $resultsPerPage = self::RESULTS_PER_PAGE)
    {
        $params = array(
            'page' => $page,
            'per_page' => $resultsPerPage,
        );

        $response = $this->client->run(sprintf('/surveys/%s/pages/%s/questions', $survey, $questionPage), HTTPMethod::GET, $params);

        if($response->isError()) {
            return $response;
        }

        return new ListResponse($response->getResponse(), $this->getClient(), PageQuestion::class);
    }

    /**
     * @param int $survey
     * @param int $question
     * @param int $questionPage
     * @return PageQuestion
     */
    public function getSurveyPagesQuestion($survey, $questionPage, $question)
    {
        $response = $this->client->run(sprintf('/surveys/%s/pages/%s/questions/%s', $survey, $questionPage, $question), HTTPMethod::GET);

        if($response->isError()) {
            return $response;
        }


        return PageQuestion::createFromString($this->getClient(), $response->getResponse()->getBody()->__toString());
    }
}