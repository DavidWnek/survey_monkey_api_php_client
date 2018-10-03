<?php

namespace davidwnek\SurveyMonkey\Service;

use davidwnek\SurveyMonkey\HTTPMethod;
use davidwnek\SurveyMonkey\Model\WebHook;
use davidwnek\SurveyMonkey\Response\CreatedResponse;
use davidwnek\SurveyMonkey\Response\ListResponse;
use davidwnek\SurveyMonkey\SurveyMonkeyException;

class WebHookService extends ClientService
{
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

    /**
     * @return array
     */
    public static function getAllEvents()
    {
        return [self::EVENT_RESPONSE_COMPLETED, self::EVENT_RESPONSE_DISQUALIFIED, self::EVENT_RESPONSE_UPDATED,
            self::EVENT_RESPONSE_CREATED, self::EVENT_RESPONSE_DELETED, self::EVENT_RESPONSE_OVERQUOTA,
            self::EVENT_COLLECTOR_CREATED, self::EVENT_COLLECTOR_UPDATED, self::EVENT_COLLECTOR_DELETED ];
    }

    /**
     * @return array
     */
    public static function getAllObjectTypes()
    {
        return [self::OBJECT_COLLECTOR, self::OBJECT_SURVEY];
    }

    /**
     * @param int $page
     * @param int $resultsPerPage
     * @return \davidwnek\SurveyMonkey\Response\ErrorResponse|ListResponse|\davidwnek\SurveyMonkey\Response\Response
     */
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

        return new ListResponse($response->getResponse(), $this->getClient(), WebHook::class);
    }

    /**
     * @param $name
     * @param $eventType
     * @param $objectType
     * @param array $objectIds
     * @param $subscriptionUrl
     * @return \davidwnek\SurveyMonkey\Response\ErrorResponse|\davidwnek\SurveyMonkey\Response\Response|\GuzzleHttp\Psr7\Response
     * @throws SurveyMonkeyException
     */
    public function createWebHook($name, $eventType, $objectType, array $objectIds, $subscriptionUrl)
    {
        if(!in_array($eventType, self::getAllEvents())) {
            throw new SurveyMonkeyException('Event type is not allowed.');
        }

        if(!in_array($objectType, self::getAllObjectTypes())){
            throw new SurveyMonkeyException('Object type is not allowed.');
        }

        $params = array(
            'name' => $name,
            'event_type' => $eventType,
            'object_type' => $objectType,
            'object_ids' => $objectIds,
            'subscription_url' => $subscriptionUrl,
        );

        $response = $this->client->run('/webhooks', HTTPMethod::POST, array(), $params);

        if($response->isError()) {
            return $response;
        }

        return new CreatedResponse($response->getResponse());
    }

    /**
     * @param $id
     * @return \davidwnek\SurveyMonkey\Response\ErrorResponse|\davidwnek\SurveyMonkey\Response\Response
     */
    public function getWebHook($id)
    {
        $response = $this->client->run(sprintf('/webhooks/%s', $id), HTTPMethod::GET);

        if($response->isError()) {
            return $response;
        }

        return $response;
    }
}