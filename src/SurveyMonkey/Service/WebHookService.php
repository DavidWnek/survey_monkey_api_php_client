<?php

namespace davidwnek\SurveyMonkey\Service;

use davidwnek\SurveyMonkey\HTTPMethod;
use davidwnek\SurveyMonkey\Response\ListResponse;
use davidwnek\SurveyMonkey\SurveyMonkeyException;

class WebHookService extends ClientService
{
    const RESULTS_PER_PAGE = 25;

    const EVENT_RESPONSE_COMPLETED = 'response_completed';
    const EVENT_RESPONSE_DISQUALIFIED = 'response_disqualified';
    const EVENT_RESPONSE_UPDATED = 'response_updated';
    const EVENT_RESPONSE_CREATED = 'response_created';
    const EVENT_RESPONSE_DELETED = 'response_deleted';
    const EVENT_RESPONSE_OVERQUOTA = 'response_overquota';
    const EVENT_COLLECTOR_CREATED = 'collector_created';
    const EVENT_COLLECTOR_UPDATED = 'collector_updated';
    const EVENT_COLLECTOR_DELETED = 'collector_deleted';

    const OBJECT_SURVEY = 'survey';
    const OBJECT_COLLECTOR = 'collector';

    public static function getAllEvents()
    {
        return [self::EVENT_RESPONSE_COMPLETED, self::EVENT_RESPONSE_DISQUALIFIED, self::EVENT_RESPONSE_UPDATED,
            self::EVENT_RESPONSE_CREATED, self::EVENT_RESPONSE_DELETED, self::EVENT_RESPONSE_OVERQUOTA,
            self::EVENT_COLLECTOR_CREATED, self::EVENT_COLLECTOR_UPDATED, self::EVENT_COLLECTOR_DELETED ];
    }

    public function getWebHooks($page = 1, $resultsPerPage = self::RESULTS_PER_PAGE)
    {
        $params = array(
            'page' => $page,
            'per_page' => $resultsPerPage,

        );

        $response = $this->client->run('/webhooks', HTTPMethod::GET, $params);

        if($response->isError()) {
            return $response;
        }

        return new ListResponse($response->getResponse());
    }

    public function createWebHook($name, $eventType, $objectType, $objectIds, $subscriptionUrl)
    {
        if(!in_array($eventType, self::getAllEvents())) {
            throw new SurveyMonkeyException('Event is not')
        }
    }
}