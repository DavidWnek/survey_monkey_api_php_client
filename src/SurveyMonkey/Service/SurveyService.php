<?php

namespace davidwnek\SurveyMonkey\Service;

use davidwnek\SurveyMonkey\HTTPMethod;
use davidwnek\SurveyMonkey\Model\Survey;
use davidwnek\SurveyMonkey\Response\ListResponse;

class SurveyService extends ClientService
{
    const RESULTS_PER_PAGE = 25;

    /**
     * @param int $page
     * @param int $resultsPerPage
     * @param string $sortBy
     * @param string $sortOrder
     * @param null $title
     * @param \DateTime|null $startModifiedAt
     * @param \DateTime|null $endModifiedAt
     *
     * @return ListResponse
     */
    public function getSurveys($page = 1, $resultsPerPage = self::RESULTS_PER_PAGE, $sortBy = 'title', $sortOrder = 'DESC',
                               $title = null, \DateTime $startModifiedAt = null, \DateTime $endModifiedAt = null)
    {
        $params = array(
            'page' => $page,
            'per_page' => $resultsPerPage,
            'sort_by' => $sortBy,
            'sort_order' => $sortOrder,
        );

        $this->appendQueryParameter($params, 'title', $title);
        $this->appendQueryParameter($params, 'start_modified_at', $startModifiedAt, 'format', 'YYYY-MM-DDTHH:SS');
        $this->appendQueryParameter($params, 'end_modified_at', $endModifiedAt, 'format', 'YYYY-MM-DDTHH:SS');

        $response = $this->client->run('/surveys', HTTPMethod::GET, $params);

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