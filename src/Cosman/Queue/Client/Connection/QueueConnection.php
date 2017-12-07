<?php
declare(strict_types = 1);
namespace Cosman\Queue\Client\Connection;

use GuzzleHttp\Client;

/**
 *
 * @author cosman
 *        
 */
class QueueConnection
{

    /**
     *
     * @var array
     */
    protected $headers = [];

    /**
     *
     * @var string
     */
    protected $baseUrl;

    /**
     *
     * @var string
     */
    protected $authToken;

    /**
     *
     * @var Client
     */
    protected $httpClient;

    /**
     *
     * @param string $baseUrl
     *            Base URL to queue server
     * @param string $authToken
     *            Authorization token
     */
    public function __construct(string $baseUrl, string $authToken)
    {
        $this->headers = array(
            'Accept' => 'application/json',
            'QUEUE-ACCESS-TOKEN' => $authToken
        );
        
        $this->baseUrl = $baseUrl;
        
        $this->authToken = $authToken;
        
        $this->httpClient = new Client(array(
            'base_uri' => $this->baseUrl,
            'headers' => $this->headers
        ));
    }

    /**
     * Returns http client used in communicating with the queue server
     *
     * @return \GuzzleHttp\Client|NULL
     */
    public function getHttpClient(): ?Client
    {
        return $this->httpClient;
    }

    /**
     * Returns request headers
     *
     * @return array
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }

    /**
     * Returns base url to queue server
     *
     * @return string|NULL
     */
    public function getBaseUrl(): ?string
    {
        return $this->baseUrl;
    }

    /**
     * Returns authorization token passed to the connector
     *
     * @return string|NULL
     */
    public function getAuthToken(): ?string
    {
        return $this->authToken;
    }
}