<?php

namespace App\Service;

use GuzzleHttp\ClientInterface;
use Illuminate\Support\Facades\Cache;

class OzonService
{
    const BASE_AUTH_URL = 'https://xapi.ozon.ru/principal-auth-api';
    const BASE_INTEGRATION_URL = 'https://xapi.ozon.ru/principal-integration-api';

    private ClientInterface $httpClient;
    private int $clientId;
    private string $clientSecret;

    public function __construct()
    {
        $this->clientId = \config('client_id');// $clientId;
        $this->clientSecret = \config('client_secret');///$clientSecret;

        $this->httpClient = new \GuzzleHttp\Client([
            'defaults' => [
                'headers' => [
                    'content-type' => 'application/json'
                ]
            ]
        ]);
    }

    public function getToken()
    {
        $tokenKey = 'token';

        $rawResponse = $this->httpClient->request('post', self::BASE_AUTH_URL . '/connect/token', [
            'form_params' => [
                'grant_type' => 'client_credentials',
                'client_id' => $this->clientId,
                'client_secret' => $this->clientSecret,
            ],
        ]);


        $response = \json_decode($rawResponse->getBody()->getContents(), true);
        $token = $response['access_token'];
        $expires = (int)$response['expires_in'];
        Cache::store('redis')->put($tokenKey, $token, $expires);

        return $token;
    }
}
