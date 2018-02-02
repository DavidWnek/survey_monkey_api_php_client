<?php

namespace davidwnek\SurveyMonkey\Service;

use davidwnek\SurveyMonkey\HTTPMethod;
use davidwnek\SurveyMonkey\Model\Survey;
use davidwnek\SurveyMonkey\Response\ListResponse;

class PagesQuestionsService extends ClientService
{
    const RESULTS_PER_PAGE = 25;

    /**
     * @param int $survey
     * @param int $question
     * @param int $page
     * @param int $resultsPerPage
     * @return ListResponse
     */
    public function getSurveyPagesQuestions($survey, $question, $page = 1, $resultsPerPage = self::RESULTS_PER_PAGE)
    {
        $params = array(
            'page' => $page,
            'per_page' => $resultsPerPage,
        );

        $response = $this->client->run(sprintf('/surveys/%s/pages/%s/questions', $survey, $question), HTTPMethod::GET, $params);

        if($response->isError()) {
            return $response;
        }

        return new ListResponse($response->getResponse(), $this->getClient(), Survey::class);
    }

    /**
     * @param array $params
     * @param string $name
     * @param mixed $value
     * @param null $function
     * @param null $parameter
     */
    private function appendQueryParameter(&$params, $name, $value, $function = null, $parameter = null)
    {
        if(empty($value)) {
            return;
        }

        if($function !== null) {
            $params[$name] = $value->$function($parameter);
            return;
        }
        $params[$name] = $value;
    }
}