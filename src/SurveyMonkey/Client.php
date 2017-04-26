<?php

namespace davidwnek\SurveyMonkey;

use davidwnek\SurveyMonkey\Response\ErrorResponse;
use davidwnek\SurveyMonkey\TokenStorage\SessionTokenStorage;
use davidwnek\SurveyMonkey\TokenStorage\TokenStorageFactory;
use davidwnek\SurveyMonkey\TokenStorage\TokenStorageInterface;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;

class Client
{
    public static $SM_STATUS_CODES = array(
        0 => "Success",
        1 => "Not Authenticated",
        2 => "Invalid User Credentials",
        3 => "Invalid Request",
        4 => "Unknown User",
        5 => "System Error",
        6 => "Plan Limit Exceeded"
    );

    /**
     * Explain Survey Monkey status code
     * @param integer $code Status code
     * @return string Definition
     */
    public static function explainStatusCode($code){
        return self::$SM_STATUS_CODES[$code];
    }

    const API_VERSION = 'v3';
    const BASE_URL = 'https://api.surveymonkey.net';

    /**
     * @var string
     */
    private $clientId;

    /**
     * @var string
     */
    private $secret;

    /**
     * @var string
     */
    private $redirectUri;

    /**
     * @var array
     */
    private $scopes;

    /**
     * @var TokenStorage\TokenStorageInterface
     */
    private $tokenStorage;

    /**
     * @var int
     */
    private $rateLimit = 0;

    /**
     * @var int
     */
    private $rateRemaining = 0;

    /**
     * Client constructor.
     * @param string $clientId
     * @param string $secret
     * @param array  $scopes
     * @param string $redirectUri
     *
     * @throws SurveyMonkeyException
     */
    public function __construct($clientId, $secret, array $scopes, $redirectUri, TokenStorageInterface $tokenStorageInterface = null)
    {
        if(empty($clientId)) {
            throw new SurveyMonkeyException('Missing Client ID');
        }

        if(empty($secret)) {
            throw new SurveyMonkeyException('Missing Secret');
        }

        if(empty($redirectUri)) {
            throw new SurveyMonkeyException('Missing Redirect URI');
        }

        $validScopes = Scope::getAllScopes();

        foreach($scopes as $scope) {
            if(!in_array($scope, $validScopes)) {
                throw new SurveyMonkeyException('Invalid Scope');
            }
        }

        $this->clientId = $clientId;
        $this->secret = $secret;
        $this->redirectUri = $redirectUri;
        $this->scopes = $scopes;

        $this->tokenStorage =  $tokenStorageInterface;
    }

    /**
     * @return string
     */
    public function getRedirectUri()
    {
        return $this->redirectUri;
    }

    /**
     * @return array
     */
    public function getScopes()
    {
        return $this->scopes;
    }

    /**
     * @return string
     */
    public function getClientId()
    {
        return $this->clientId;
    }

    /**
     * @return string
     */
    public function getSecret()
    {
        return $this->secret;
    }

    /**
     * @return TokenStorage\TokenStorageInterface
     */
    public function getTokenStorage()
    {
        return $this->tokenStorage;
    }

    /**
     * @return int
     */
    public function getRateLimit()
    {
        return $this->rateLimit;
    }

    /**
     * @return int
     */
    public function getRateRemaining()
    {
        return $this->rateRemaining;
    }

    /**
     * @param string $uri
     * @param string $method
     * @param array $queryParams
     * @param array $body
     * @return \davidwnek\SurveyMonkey\Response\Response|ErrorResponse
     * @throws SurveyMonkeyException
     *
     * @return Response
     */
    public function run($uri, $method, array $queryParams = array(), array $body = array())
    {
        $url = sprintf('/%s%s', self::API_VERSION, $uri);

        return $this->runUrl($url, $method, $queryParams, $body);
    }

    /**
     * @param string $url
     * @param string $method
     * @param array $queryParams
     * @param array $body
     * @return \davidwnek\SurveyMonkey\Response\Response|ErrorResponse
     * @throws SurveyMonkeyException
     *
     * @return Response
     */
    public function runUrl($url, $method, array $queryParams = array(), array $body = array())
    {
        if(!in_array($method, HTTPMethod::getAllMethods())) {
            throw new SurveyMonkeyException('Invalid Method');
        }

        if(count($queryParams) > 0) {
            $url .= sprintf('?%s', http_build_query($queryParams));
        }

        $client = $this->getGuzzleClient();

        $body = $method === HTTPMethod::POST ? json_encode($body) : null;

        try {
            $request = new Request(strtoupper($method), $url, array(
                'Authorization' => sprintf('BEARER %s', $this->getTokenStorage()->getToken()->getAccessToken()),
                'Content-Type' => 'application/json'
            ), $body);

            $res = $client->send($request);

            $responseType = \davidwnek\SurveyMonkey\Response\Response::class;
        } catch (RequestException $exception) {
            $res = $exception->getResponse();
            $responseType = ErrorResponse::class;
        }
        finally {
            if($res->hasHeader('X-Ratelimit-App-Global-Day-Limit')) {
                $this->rateLimit = $res->getHeader('X-Ratelimit-App-Global-Day-Limit');
            }

            if($res->hasHeader('X-Ratelimit-App-Global-Day-Remaining')) {
                $this->rateRemaining = $res->getHeader('X-Ratelimit-App-Global-Day-Remaining');
            }
            return new $responseType($res);
        }
    }

    /**
     * @return \GuzzleHttp\Client
     */
    public function getGuzzleClient()
    {
        return new \GuzzleHttp\Client([
            'base_uri' => self::BASE_URL,
            'timeout'  => 15.0,
        ]);
    }
}