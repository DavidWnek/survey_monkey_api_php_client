<?php

namespace davidwnek\SurveyMonkey\Service;

use davidwnek\SurveyMonkey\Client;

class ClientService
{
    const RESULTS_PER_PAGE = 25;

    /**
     * @var Client
     */
    protected $client;

    /**
     * ClientService constructor.
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @return Client
     */
    public function getClient()
    {
        return $this->client;
    }
}