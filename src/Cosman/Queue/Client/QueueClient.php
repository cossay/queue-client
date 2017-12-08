<?php
declare(strict_types = 1);
namespace Cosman\Queue\Client;

use Cosman\Queue\Client\Connection\QueueConnection;
use Cosman\Queue\Client\Http\Request\ProjectRequest;
use function GuzzleHttp\Promise\settle;

/**
 *
 * @author cosman
 *        
 */
class QueueClient
{

    /**
     *
     * @var QueueConnection
     */
    protected $connection;

    /**
     *
     * @var ProjectRequest
     */
    protected $projectRequest;

    /**
     *
     * @param QueueConnection $connection
     */
    public function __construct(QueueConnection $connection)
    {
        $this->connection = $connection;
        
        $this->projectRequest = new ProjectRequest($connection);
    }

    /**
     * Returns request service for querying projects on the server
     *
     * @return ProjectRequest
     */
    public function projects(): ProjectRequest
    {
        return $this->projectRequest;
    }
}