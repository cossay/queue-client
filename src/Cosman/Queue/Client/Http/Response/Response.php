<?php
declare(strict_types = 1);
namespace Cosman\Queue\Client\Http\Response;

/**
 *
 * @author cosman
 *        
 */
class Response
{

    /**
     *
     * @var int
     */
    protected $code;

    /**
     *
     * @var string
     */
    protected $message;

    /**
     *
     * @var mixed
     */
    protected $payload;

    /**
     *
     * @return int|NULL
     */
    public function getCode(): ?int
    {
        return $this->code;
    }

    /**
     *
     * @param int $code
     * @return self
     */
    public function setCode(?int $code): self
    {
        $this->code = $code;
        
        return $this;
    }

    /**
     *
     * @return string|NULL
     */
    public function getMessage(): ?int
    {
        return $this->message;
    }

    /**
     *
     * @param string $message
     * @return self
     */
    public function setMessage(?string $message): self
    {
        $this->message = $message;
        
        return $this;
    }

    /**
     *
     * @return mixed
     */
    public function getPayload()
    {
        return $this->payload;
    }

    /**
     *
     * @param mixed $payload
     * @return self
     */
    public function setPayload($payload): self
    {
        $this->payload = $payload;
        
        return $this;
    }
}