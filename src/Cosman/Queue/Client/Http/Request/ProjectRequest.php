<?php
declare(strict_types = 1);
namespace Cosman\Queue\Client\Http\Request;

use Cosman\Queue\Client\Model\BaseModel;
use Cosman\Queue\Client\Model\Client;
use Cosman\Queue\Client\Model\Project;
use GuzzleHttp\Promise\PromiseInterface;
use Psr\Http\Message\ResponseInterface;

/**
 *
 * @author cosman
 *        
 */
class ProjectRequest extends BaseRequest
{

    /**
     * Generate request to create a new project
     *
     * @param Project $project
     * @return PromiseInterface
     */
    public function create(Project $project): PromiseInterface
    {
        $promise = $this->connection->getHttpClient()->postAsync('projects', array(
            'json' => array(
                'name' => $project->getName(),
                'description' => $project->getDescription()
            )
        ));
        
        return $promise->then(function (ResponseInterface $response) {
            return $this->format($this->decodeReponse($response)
                ->getPayload());
        });
    }

    /**
     * Generate request to update existing project
     *
     * @param Project $project
     * @return PromiseInterface
     */
    public function update(Project $project): PromiseInterface
    {
        $promise = $this->connection->getHttpClient()->putAsync(sprintf('projects/%s', $project->getCode()), array(
            'json' => array(
                'name' => $project->getName(),
                'description' => $project->getDescription()
            )
        ));
        
        return $promise->then(function (ResponseInterface $response) {
            return $this->format($this->decodeReponse($response)
                ->getPayload());
        });
    }

    /**
     * Generates request to fetch a number of projects
     *
     * @param int $limit
     * @param int $offset
     * @return PromiseInterface
     */
    public function fetch(int $limit = self::MAX_FETCH_LIMIT, int $offset = self::MIN_FETCH_OFFSET): PromiseInterface
    {
        $promise = $this->connection->getHttpClient()->getAsync('projects', array(
            'query' => array(
                'limit' => $limit,
                'offset' => $offset
            )
        ));
        
        return $promise->then(function (ResponseInterface $response) {
            return $this->formatResponses($this->decodeReponse($response));
        });
    }

    /**
     *
     * {@inheritdoc}
     * @see \Cosman\Queue\Client\Http\Request\BaseRequest::format()
     */
    protected function format($model): ?BaseModel
    {
        $project = Project::createInstance($model);
        
        if (! ($project instanceof Project)) {
            return null;
        }
        
        $client = Client::createInstance($model['client'] ?? []);
        
        if ($client) {
            $project->setClient($client);
        }
        
        return $project;
    }
}