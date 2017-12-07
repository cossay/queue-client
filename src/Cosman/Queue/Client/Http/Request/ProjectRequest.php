<?php
declare(strict_types = 1);
namespace Cosman\Queue\Client\Http\Request;

use GuzzleHttp\Promise\PromiseInterface;
use Psr\Http\Message\ResponseInterface;
use Cosman\Queue\Client\Http\Response\Response;
use Cosman\Queue\Client\Model\Project;

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
            'name' => $project->getName(),
            'description' => $project->getDescription()
        ));
        
        return $promise->then(function (ResponseInterface $response) {
            return $this->formatResponse($this->decodeReponse($response)
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
            return $this->formatResponses($this->decodeReponse($response)
                ->getPayload());
        });
    }

    /**
     *
     * {@inheritdoc}
     * @see \Cosman\Queue\Client\Http\Request\BaseRequest::formatResponse()
     */
    protected function formatResponse(Response $response)
    {
        if (200 !== $response->getCode()) {
            throw new \Exception($response->getMessage(), $response->getCode());
        }
        
        return Project::createInstance($response->getPayload());
    }
}