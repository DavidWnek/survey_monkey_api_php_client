<?php

namespace davidwnek\SurveyMonkey\Model;

use davidwnek\SurveyMonkey\Client;
use davidwnek\SurveyMonkey\HTTPMethod;
use davidwnek\SurveyMonkey\Service\ClientService;
use davidwnek\SurveyMonkey\SurveyMonkeyException;

abstract class Model
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $href;

    /**
     * @var bool
     */
    private $isLoaded = false;

    /**
     * @var Client
     */
    private $client;

    /**
     * @param Client $client
     * @param string$data
     * @param bool $autoLoad
     * @return Model
     * @throws SurveyMonkeyException
     */
    static public function createFromString(Client $client, $data, $autoLoad = false)
    {
        if(!is_string($data)) {
            throw new SurveyMonkeyException('Model Data is not of type: String');
        }

        $json = json_decode($data);

        if($json === null) {
            throw new SurveyMonkeyException('Invalid JSON');
        }

        return new static($client, $json, $autoLoad);
    }

    /**
     * @param Client $client
     * @param array|object $json
     * @param bool $autoLoad
     * @return Model
     * @throws SurveyMonkeyException
     */
    static public function createFromJson(Client $client, $json, $autoLoad = false)
    {
        if($json === null) {
            throw new SurveyMonkeyException('Invalid JSON');
        }

        return new static($client, $json, $autoLoad);
    }

    /**
     * Model constructor.
     * @param Client $client
     * @param array|object $data
     * @param bool $autoLoad
     */
    protected function __construct(Client $client, $data, $autoLoad)
    {
        $this->client = $client;
        $this->onLoad($data);

        if(!empty($href) && $client instanceof Client && $autoLoad) {
            $this->load();
        }
    }

    /**
     * @param Client $client
     */
    public function setClient(Client $client)
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

    /**
     * @return boolean
     */
    public function isLoaded()
    {
        return $this->isLoaded;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Model
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getHref()
    {
        return $this->href;
    }

    /**
     * @param string $href
     * @return Model
     */
    public function setHref($href)
    {
        $this->href = $href;
        return $this;
    }

    /**
     * @param bool $forceReload
     * @throws SurveyMonkeyException
     */
    public function load($forceReload = false)
    {
        if($this->isLoaded && !$forceReload) {
            return;
        }

        if(!$this->client instanceof Client) {
            throw new SurveyMonkeyException('Model does not have a Client!');
        }

        $res = $this->client->runUrl($this->href, HTTPMethod::GET);

        if(!$res->isError()) {
            $this->onLoad(json_decode($res->getBody()->__toString()));
            $this->isLoaded = true;
        }
    }

    /**
     * @param string $input
     * @param string $separator
     * @return string
     */
    protected function camelize($input, $separator = '_')
    {
        return lcfirst(join(array_map('ucfirst', explode($separator, $input))));
    }

    /**
     * @param array|object $data
     */
    protected function onLoad($data)
    {
        foreach($data as $item => $value) {
            $this->{$this->camelize($item)} = $value;
        }
    }
}