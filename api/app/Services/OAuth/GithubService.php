<?php

namespace App\Services\OAuth;

use App\Contracts\OAuthContract;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;


class GithubService implements OAuthContract
{
    private Client $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://api.github.com',
            'timeout' => 5.0
        ]);
    }

    public function auth($code): array
    {
       return [];

        $url = "https://github.com/login/oauth/access_token";
        try {
            $response = $this->client->request('POST', $url, [
                'form_params' => [
                    'client_id' => env('GITHUB_OAUTH_ID'),
                    'client_secret' => env('GITHUB_OAUTH_SECRET'),
                    'code' => $code,
                ],
                'headers' => [
                    'Accept' => 'application/json'
                ]
            ]);
            return json_decode($response->getBody(), true);
        } catch (GuzzleException $exception) {
            return ["deu merda: " . $exception->getMessage()];
        }
    }

    public function create(array $data): array
    {
        return [];
    }

    public function getAuthenticatedUser($code): array
    {
        return [];
    }
}
