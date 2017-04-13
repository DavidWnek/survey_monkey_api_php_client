<?php

namespace davidwnek\SurveyMonkey;

class Authentication
{
    private $client;

    public function __construct(Client $client)
    {
        if(empty($client)) {
            throw new SurveyMonkeyException('No Client provided');
        }

        $this->client = $client;
    }

    /**
     * @return string
     */
    public function getOAuthLoginUrl()
    {
        $params = array(
            'response_type' => 'code',
            'client_id' => $this->client->getClientId(),
            'redirect_uri' => $this->client->getRedirectUri(),
        );

        return sprintf('%s/oauth/authorize?%s', Client::BASE_URL, http_build_query($params));
    }

    /**
     * @param string $code
     */
    public function storeAccessToken($code)
    {
        /** @var \GuzzleHttp\Client $guzzle */
        $guzzle = $this->client->getGuzzleClient();

        $response = $guzzle->post('oauth/token', array(
            'form_params' => array(
                'client_secret' => $this->client->getSecret(),
                'code' => $code,
                'redirect_uri' => $this->client->getRedirectUri(),
                'client_id' => $this->client->getClientId(),
                'grant_type' => 'authorization_code'
            )
        ));

        $json = json_decode($response->getBody());

        $this->client->getTokenStorage()->storeToken(new Token($json->access_token));
    }

    /**
     * @return Token|null
     */
    public function getToken()
    {
        return $this->client->getTokenStorage()->getToken();
    }
}