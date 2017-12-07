<?php
declare(strict_types = 1);
namespace Cosman\Queue\Client;

use Cosman\Queue\Client\Connection\QueueConnection;

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
     * @param QueueConnection $connection
     */
    public function __construct(QueueConnection $connection)
    {
        $this->connection = $connection;
    }
    
    public function projects() {
        
    }
}