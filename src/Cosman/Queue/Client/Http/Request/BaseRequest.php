<?php
declare(strict_types = 1);
namespace Cosman\Queue\Client\Http\Request;

use Cosman\Queue\Client\Connection\QueueConnection;
use Psr\Http\Message\ResponseInterface;
use Cosman\Queue\Client\Support\Reader\PropertyReader;
use Cosman\Queue\Client\Http\Response\Response;
use Cosman\Queue\Client\Http\Response\Collection;
use Cosman\Queue\Client\Model\BaseModel;
use Cosman\Queue\Client\Exception\QueueClientException;

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
        
        $decodedResponse->setCode($reader->read('code'))
            ->setMessage($reader->read('message'))
            ->setPayload($reader->read('payload'));
        
        if (200 !== $decodedResponse->getCode()) {
            throw new QueueClientException((string) $decodedResponse->getMessage(), (int) $decodedResponse->getCode());
        }
        
        return $decodedResponse;
    }

    /**
     * Formats a response that contains a list of items
     *
     * @param Response $response
     * @return \Cosman\Queue\Client\Http\Response\Collection
     */
    protected function formatResponses(Response $response): Collection
    {
        $payload = $response->getPayload();
        
        $modelArray = $payload['collection'] ?? [];
        $modelCounts = $payload['recordCounts'] ?? 0;
        $hasMoreModels = $payload['hasMore'] ?? false;
        
        $formatted = [];
        
        foreach ($modelArray as $model) {
            $formatted[] = $this->format($model);
        }
        
        return new Collection($formatted, $modelCounts, $hasMoreModels);
    }

    /**
     * Formats a model containing a single item
     *
     * @param mixed $model
     * @return \Cosman\Queue\Client\Model\BaseModel|NULL
     */
    abstract protected function format($model): ?BaseModel;
}