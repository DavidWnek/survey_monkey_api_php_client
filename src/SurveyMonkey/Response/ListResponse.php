<?php

namespace davidwnek\SurveyMonkey\Response;

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

    public function __construct(\GuzzleHttp\Psr7\Response $response)
    {
        parent::__construct($response);

        $json = json_decode($this->getBody()->__toString());

        $this->resultsPerPage = $json->per_page;
        $this->totalResults = $json->total;
        $this->data = $json->data;
        $this->page = $json->page;
        $this->selfLink = $this->getLink($json, 'self');
        $this->nextLink = $this->getLink($json, 'next');
        $this->previousLink = $this->getLink($json, 'previous');
        $this->firstLink = $this->getLink($json, 'first');
        $this->lastLink = $this->getLink($json, 'last');
    }

    private function getLink($json, $property)
    {
        if(key_exists($property, $json->links)) {
            return $json->links->$property;
        }

        return null;
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