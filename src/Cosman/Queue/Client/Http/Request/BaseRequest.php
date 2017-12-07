<?php
declare(strict_types = 1);
namespace Cosman\Queue\Client\Http\Request;

use Cosman\Queue\Client\Connection\QueueConnection;
use Psr\Http\Message\ResponseInterface;
use Cosman\Queue\Client\Support\Reader\PropertyReader;
use Cosman\Queue\Client\Http\Response\Response;

/**
 *
 * @author cosman
 *        
 */
abstract class BaseRequest
{

    const MAX_FETCH_LIMIT = 200;

    const MIN_FETCH_OFFSET = 0;

    /**
     *
     * @var QueueConnection
     */
    protected $connection;

    /**
     *
     * @param QueueConnection $connection
     */
    public function __construct(QueueConnection $connection)
    {
        $this->connection = $connection;
    }

    /**
     *
     * @param ResponseInterface $response
     * @return \Cosman\Queue\Client\Http\Response\Response
     */
    protected function decodeReponse(ResponseInterface $response): Response
    {
        $data = json_decode($response->getBody()->getContents(), true);
        
        $reader = new PropertyReader($data);
        
        $decodedResponse = new Response();
        
        return $decodedResponse->setCode($reader->read('code'))
            ->setMessage($reader->read('message'))
            ->setPayload($reader->read('payload'));
    }

    /**
     * Formats a collection of responses
     * 
     * @param iterable $models
     * @return iterable
     */
    protected function formatResponses(iterable $models): iterable
    {
        $formatted = [];
        
        foreach ($models as $model) {
            $formatted[] = $this->formatResponse($model);
        }
        
        return $formatted;
    }

    /**
     * Formats a single response
     *
     * @param mixed $model
     */
    abstract protected function formatResponse($model);
}