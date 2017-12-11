<?php
declare(strict_types = 1);
namespace Cosman\Queue\Client\Http\Request;

use Cosman\Queue\Client\Model\BaseModel;
use Cosman\Queue\Client\Model\Client;
use GuzzleHttp\Promise\PromiseInterface;
use Psr\Http\Message\ResponseInterface;

/**
 *
 * @author cosman
 *        
 */
class ClientRequest extends BaseRequest
{

    /**
     * Generates request to create a new client
     *
     * @param Client $client
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function create(Client $client): PromiseInterface
    {
        $promise = $this->connection->getHttpClient()->postAsync('clients', array(
            'json' => $client->toQueueEntity()
        ));
        
        return $promise->then(function (ResponseInterface $response) {
            return Client::createInstance($this->decodeReponse($response)
                ->getPayload());
        });
    }

    /**
     *
     * {@inheritdoc}
     * @see \Cosman\Queue\Client\Http\Request\BaseRequest::format()
     */
    protected function format($model): ?BaseModel
    {
        return Client::createInstance($model);
    }
}