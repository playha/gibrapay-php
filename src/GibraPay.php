<?php
namespace GibraPay;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\GuzzleException;

/**
 * Class GibraPay
 * @package GibraPay
 */
class GibraPay {
    /** @var Client */
    protected $client;

    /** @var string */
    protected $apiKey;

    /** @var string|null */
    protected $walletId;

    /** @var string */
    protected $baseUrl = 'https://gibrapay.online';

    /**
     * GibraPay constructor.
     * @param string $apiKey
     * @param string|null $walletId
     * @throws \InvalidArgumentException
     */
    public function __construct($apiKey, $walletId = null) {
        if (empty($apiKey)) {
            throw new \InvalidArgumentException('API key is required');
        }

        $this->apiKey = $apiKey;
        $this->walletId = $walletId;
        $this->client = new Client([
            'base_uri' => $this->baseUrl,
            'headers' => [
                'api-key' => $this->apiKey,
                'Accept' => 'application/json',
            ]
        ]);
    }

    /**
     * Make a request to the API
     * @param string $method
     * @param string $endpoint
     * @param array $data
     * @return array
     * @throws \Exception
     */
    protected function makeRequest($method, $endpoint, $data = []) {
        try {
            $options = [];
            
            if ($method === 'GET') {
                $options['query'] = $data;
            } else {
                $options['json'] = $data;
            }

            $response = $this->client->request($method, $endpoint, $options);
            return json_decode($response->getBody(), true);
        } catch (RequestException $e) {
            $response = $e->getResponse();
            $error = json_decode($response->getBody(), true);
            throw new \Exception($error['message'] ?? 'API request failed', $response->getStatusCode());
        }
    }
}