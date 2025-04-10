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

    /** @var array */
    protected $defaultHeaders = [
        'Accept' => 'application/json',
        'Content-Type' => 'application/json'
    ];

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
        
        $headers = array_merge($this->defaultHeaders, [
            'api-key' => $this->apiKey
        ]);

        $this->client = new Client([
            'base_uri' => $this->baseUrl,
            'headers' => $headers,
            'timeout' => 30,
            'connect_timeout' => 10
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
            $body = $response->getBody()->getContents();
            
            $result = json_decode($body, true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new \Exception('Invalid JSON response from API');
            }
            
            return $result;
        } catch (RequestException $e) {
            $response = $e->getResponse();
            if ($response) {
                $body = $response->getBody()->getContents();
                $error = json_decode($body, true);
                $message = $error['message'] ?? 'API request failed';
                $code = $response->getStatusCode();
            } else {
                $message = $e->getMessage();
                $code = 0;
            }
            throw new \Exception($message, $code);
        } catch (GuzzleException $e) {
            throw new \Exception('Network error: ' . $e->getMessage());
        }
    }
}