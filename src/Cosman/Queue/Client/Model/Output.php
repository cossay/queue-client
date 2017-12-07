<?php
declare(strict_types = 1);
namespace Cosman\Queue\Client\Model;

use Cosman\Queue\Client\Support\Reader\PropertyReader;

/**
 * Job output class
 *
 * @author cosman
 *        
 */
class Output extends BaseModel
{

    /**
     *
     * @var string
     */
    protected $code;

    /**
     *
     * @var Job
     */
    protected $job;

    /**
     *
     * @var mixed
     */
    protected $content;

    /**
     *
     * @var string[][]
     */
    protected $headers = [];

    /**
     *
     * @var int
     */
    protected $status_code;

    /**
     * Returns output unique code
     *
     * @return string|NULL
     */
    public function getCode(): ?string
    {
        return $this->code;
    }

    /**
     * Sets output unique code
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
     *
     * @var string
     */
    protected $status_message;

    /**
     * Returns job
     *
     * @return Job|NULL
     */
    public function getJob(): ?Job
    {
        return $this->job;
    }

    /**
     * Sets job for output
     *
     * @param Job $job
     * @return self
     */
    public function setJob(?Job $job): self
    {
        $this->job = $job;
        
        return $this;
    }

    /**
     * Returns output content
     *
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Sets content for output
     *
     * @param mixed $content
     * @return self
     */
    public function setContent($content): self
    {
        $this->content = $content;
        
        return $this;
    }

    /**
     * Returns output headers
     *
     * @return string[][]
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }

    /**
     * Sets headers for output
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
     * Returns output status code
     *
     * @return int
     */
    public function getStatusCode()
    {
        return $this->status_code;
    }

    /**
     * Sets status code for output
     *
     * @param int $code
     * @return self
     */
    public function setStatusCode(?int $code): self
    {
        $this->status_code = $code;
        
        return $this;
    }

    /**
     * Returns output status message
     *
     * @return string
     */
    public function getStatusMessage()
    {
        return $this->status_message;
    }

    /**
     * Sets status message for output
     *
     * @param string $message
     * @return self
     */
    public function setStatusMessage(?string $message): self
    {
        $this->status_message = $message;
        
        return $this;
    }

    /**
     * Creates a new instace from a given value
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
        
        $id = (int) $reader->read('id');
        
        if (! $id) {
            return null;
        }
        
        $instance = new static();
        $instance->setId($id);
        $instance->setCode((string) $reader->read('code'));
        $instance->setContent((string) $reader->read('content'));
        
        $headers = $reader->read('headers');
        
        if (is_string($headers)) {
            $headers = json_decode($headers, true);
            
            if (! is_array($headers)) {
                $headers = (array) $headers;
            }
            $instance->setHeaders($headers);
        }
        $instance->setStatusCode((int) $reader->read('status_code'));
        $instance->setStatusMessage((string) $reader->read('message'));
        $instance->setCreatedAt($instance->createDatetime((string) $reader->read('created_at')));
        $instance->setUpdatedAt($instance->createDatetime((string) $reader->read('updated_at')));
        
        return $instance;
    }
}