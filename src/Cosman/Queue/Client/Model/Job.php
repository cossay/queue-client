<?php
declare(strict_types = 1);
namespace Cosman\Queue\Client\Model;

use Cosman\Queue\Client\Support\Reader\PropertyReader;
use Cosman\Queue\Client\Support\DateTime\DateTime;

/**
 *
 * @author cosman
 *        
 */
class Job extends BaseModel
{

    const STATUS_EXECUTED = 1;

    const STATUS_NOT_EXECUTED = 0;

    const MIN_JOB_RETRIES = 1;

    const MAX_JOB_RETRIES = 10;

    /**
     *
     * @var string
     */
    protected $code;

    /**
     *
     * @var string
     */
    protected $title;

    /**
     *
     * @var string
     */
    protected $description;

    /**
     *
     * @var Project
     */
    protected $project;

    /**
     *
     * @var mixed
     */
    protected $payload;

    /**
     *
     * @var string[][]
     */
    protected $headers = [];

    /**
     *
     * @var DateTime
     */
    protected $next_execution;

    /**
     *
     * @var string
     */
    protected $callback_url;

    /**
     *
     * @var string
     */
    protected $request_method = 'GET';

    /**
     *
     * @var int
     */
    protected $retries = 1;

    /**
     *
     * @var int
     */
    protected $retry_counts = 0; 

    /**
     *
     * @var bool
     */
    protected $is_executed = false;

    /**
     *
     * @var int
     */
    protected $delay = 0;

    /**
     * Returns job unique code
     *
     * @return string|NULL
     */
    public function getCode(): ?string
    {
        return $this->code;
    }

    /**
     * Sets job unique code
     *
     * @param string $code
     * @return self
     */
    public function setCode(?string $code): self
    {
        $this->code = $code;
        
        return $this;
    }

    /**
     * Returns job title
     *
     * @return string|NULL
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * Sets job title
     *
     * @param string $title
     * @return self
     */
    public function setTitle(?string $title): self
    {
        $this->title = $title;
        
        return $this;
    }

    /**
     * Returns job descripion
     *
     * @return string|NULL
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * Sets job description
     *
     * @param string $description
     * @return self
     */
    public function setDescription(?string $description): self
    {
        $this->description = $description;
        
        return $this;
    }

    /**
     * Returns a job's project
     *
     * @return \Cosman\Queue\Client\Model\Project|NULL
     */
    public function getProject(): ?Project
    {
        return $this->project;
    }

    /**
     * Sets a job's project
     *
     * @param Project $project
     * @return self
     */
    public function setProject(?Project $project): self
    {
        $this->project = $project;
        
        return $this;
    }

    /**
     * Returns job payload
     *
     * @return mixed
     */
    public function getPayload()
    {
        return $this->payload;
    }

    /**
     * Sets job payload
     *
     * @param mixed $payload
     * @return self
     */
    public function setPayload($payload): self
    {
        $this->payload = $payload;
        
        return $this;
    }

    /**
     * Returns jobs headers
     *
     * @return string[][]
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }

    /**
     * Sets headers for job
     *
     * @param string[][] $headers
     * @return self
     */
    public function setHeaders(array $headers): self
    {
        $this->headers = $headers;
        
        return $this;
    }

    /**
     * Returns job's next execution time
     *
     * @return DateTime | NULL
     */
    public function getNextExecution(): ?DateTime
    {
        return $this->next_execution;
    }

    /**
     * Sets ob's next execution time
     *
     * @param DateTime $datetime
     * @return self
     */
    public function setNextExecution(?DateTime $datetime): self
    {
        $this->next_execution = $datetime;
        
        return $this;
    }

    /**
     * Returns callback url
     *
     * @return string|NULL
     */
    public function getCallbackUrl(): ?string
    {
        return $this->callback_url;
    }

    /**
     * Sets callback url
     *
     * @param string $callback_url
     * @return self
     */
    public function setCallbackUrl(?string $callback_url): self
    {
        $this->callback_url = $callback_url;
        
        return $this;
    }

    /**
     * Returns request method
     *
     * @return string|NULL
     */
    public function getRequestMethod(): ?string
    {
        return $this->request_method;
    }

    /**
     * Sets request method
     *
     * @param string $callback_url
     * @return self
     */
    public function setRequestMethod(?string $method): self
    {
        $this->request_method = $method;
        
        return $this;
    }

    /**
     * Returns number of retries for a job
     *
     * @return int|NULL
     */
    public function getRetries(): ?int
    {
        return $this->retries;
    }

    /**
     * Sets number of retries for a job
     *
     * @param int $retries
     * @return self
     */
    public function setRetries(?int $retries): self
    {
        $this->retries = $retries;
        
        return $this;
    }

    /**
     * Returns number of times a job has been tried
     *
     * @return int|NULL
     */
    public function getTriedCounts(): ?int
    {
        return $this->retry_counts;
    }

    /**
     * Sets number of times a job has been tried
     *
     * @param int $counts
     * @return self
     */
    public function setTriedCounts(?int $counts): self
    {
        $this->retry_counts = $counts;
        
        return $this;
    }

    /**
     * Tells whether a job has been executed at least once
     *
     * @return bool|NULL
     */
    public function isExecuted(): ?bool
    {
        return $this->is_executed;
    }

    /**
     * Sets execution state of a job
     *
     * @param bool $state
     * @return self
     */
    public function setIsExecuted(?bool $state): self
    {
        $this->is_executed = $state;
        
        return $this;
    }

    /**
     * Returns number of seconds a job should be delayed before being executed
     *
     * @return int|NULL
     */
    public function getDelay(): ?int
    {
        return $this->delay;
    }

    /**
     * Sets number of seconds a job should be delayed before being executed
     *
     * @param int $delay
     * @return self
     */
    public function setDelay(?int $delay): self
    {
        $this->delay = $delay;
        
        return $this;
    }

    /**
     * Checks if a given output belongs to job
     *
     * @param Output $output
     * @return bool
     */
    public function ownsOutput(?Output $output): bool
    {
        return (null !== $output) && ($output->getJob() instanceof Job) && ($output->getJob()->getId() === $this->getId());
    }

    /**
     *
     * @param mixed $model
     * @param string $prefix
     * @param string $suffix
     * @param mixed $default
     * @return BaseModel|NULL
     */
    public static function createInstance($model, string $prefix = '', string $suffix = '', $default = null): ?BaseModel
    {
        if (! $model) {
            return null;
        }
        
        $reader = new PropertyReader($model, $prefix, $suffix);
        
        $id = $reader->read('id');
        
        if (empty($id)) {
            return null;
        }
        
        $instance = new static();
        
        $instance->setId((int) $id);
        $instance->setCode((string) $reader->read('code'));
        $instance->setTitle((string) $reader->read('title'));
        $instance->setDescription((string) $reader->read('description'));
        $instance->setDelay((int) $reader->read('delay'));
        
        $payload = $reader->read('payload');
        
        if (is_string($payload)) {
            $payload = json_decode($payload, true);
            
            $instance->setPayload($payload);
        }
        
        $headers = $reader->read('headers');
        
        if (is_string($headers)) {
            $headers = json_decode($headers, true);
            
            if (! is_array($headers)) {
                $headers = (array) $headers;
            }
            
            $instance->setHeaders($headers);
        }
        
        $instance->setCallbackUrl((string) $reader->read('callback_url'));
        $instance->setRequestMethod((string) $reader->read('request_method'));
        $instance->setRetries((int) $reader->read('retries'));
        $instance->setTriedCounts((int) $reader->read('retry_counts'));
        $instance->setIsExecuted(Job::STATUS_EXECUTED === $reader->read('is_executed'));
        $instance->setNextExecution($instance->createDatetime((string) $reader->read('next_execution')));
        $instance->setCreatedAt($instance->createDatetime((string) $reader->read('created_at')));
        $instance->setUpdatedAt($instance->createDatetime((string) $reader->read('updated_at')));
        
        return $instance;
    }
}