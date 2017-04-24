<?php

namespace davidwnek\SurveyMonkey\Response;

use davidwnek\SurveyMonkey\Client;
use davidwnek\SurveyMonkey\HTTPMethod;
use davidwnek\SurveyMonkey\Model\Model;
use davidwnek\SurveyMonkey\SurveyMonkeyException;

class ListResponse extends Response
{
    /**
     * @var integer
     */
    private $resultsPerPage;

    /**
     * @var integer
     */
    private $totalResults;

    /**
     * @var array
     */
    private $data;

    /**
     * @var integer
     */
    private $page;

    /**
     * @var string
     */
    private $selfLink;

    /**
     * @var string
     */
    private $nextLink;

    /**
     * @var string
     */
    private $lastLink;

    /**
     * @var string
     */
    private $previousLink;

    /**
     * @var string
     */
    private $firstLink;

    /**
     * @var Client
     */
    private $client;

    private $class;

    /**
     * ListResponse constructor.
     * @param \GuzzleHttp\Psr7\Response $response
     * @param Client $client
     * @param string|null $class
     */
    public function __construct(\GuzzleHttp\Psr7\Response $response, Client $client, $class = null)
    {
        parent::__construct($response);

        $json = json_decode($this->getBodyText());

        $this->class = $class;
        $this->client = $client;
        $this->data = array();
        $this->resultsPerPage = $json->per_page;
        $this->totalResults = $json->total;
        $this->page = $json->page;
        $this->selfLink = $this->getLink($json, 'self');
        $this->nextLink = $this->getLink($json, 'next');
        $this->previousLink = $this->getLink($json, 'previous');
        $this->firstLink = $this->getLink($json, 'first');
        $this->lastLink = $this->getLink($json, 'last');

        if($class !== null && get_parent_class($class) === Model::class) {
            foreach($json->data as $data) {
                $this->data[] = new $class($client, $data);
            }
        } else {
            $this->data = $json->data;
        }
    }

    private function getLink($json, $property)
    {
        if(key_exists($property, $json->links)) {
            return $json->links->$property;
        }

        return null;
    }

    public function getNext()
    {
        /** @var Response $response */
        $response = $this->client->runUrl($this->nextLink, HTTPMethod::GET);

        if($response->isError()) {
            return new ErrorResponse($response->getResponse());
        }

        return new ListResponse($response->getResponse(), $this->client, $this->class);
    }

    /**
     * @return int
     */
    public function getResultsPerPage()
    {
        return $this->resultsPerPage;
    }

    /**
     * @return int
     */
    public function getTotalResults()
    {
        return $this->totalResults;
    }

    /**
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @return int
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * @return string
     */
    public function getSelfLink()
    {
        return $this->selfLink;
    }

    /**
     * @return string
     */
    public function getNextLink()
    {
        return $this->nextLink;
    }

    /**
     * @return string
     */
    public function getLastLink()
    {
        return $this->lastLink;
    }

    /**
     * @return string
     */
    public function getPreviousLink()
    {
        return $this->previousLink;
    }

    /**
     * @return string
     */
    public function getFirstLink()
    {
        return $this->firstLink;
    }
}