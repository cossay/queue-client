<?php
declare(strict_types = 1);
namespace Cosman\Queue\Client\Model;

use Cosman\Queue\Client\Support\Reader\PropertyReader;

/**
 *
 * @author cosman
 *        
 */
class Client extends BaseModel
{

    const STATUS_BLOCKED = 1;

    const STATUS_UNBLOCKED = 0;

    /**
     *
     * @var string
     */
    protected $name;

    /**
     *
     * @var string
     */
    protected $email;

    /**
     *
     * @var string
     */
    protected $password;

    /**
     *
     * @var string
     */
    protected $token;

    /**
     *
     * @var bool
     */
    protected $is_blocked = false;

    /**
     * Returns client name
     *
     * @return string|NULL
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Sets client name
     *
     * @param string $name
     * @return self
     */
    public function setName(?string $name): self
    {
        $this->name = $name;
        
        return $this;
    }

    /**
     * Returns client email address
     *
     * @return string|NULL
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * Sets client email address
     *
     * @param string $email
     * @return self
     */
    public function setEmail(?string $email): self
    {
        $this->email = $email;
        
        return $this;
    }

    /**
     * Returns client password
     *
     * @return string|NULL
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * Sets client password
     *
     * @param string $password
     * @return self
     */
    public function setPassword(?string $password): self
    {
        $this->password = $password;
        
        return $this;
    }

    /**
     * Returns client authorization token
     *
     * @return string|NULL
     */
    public function getToken(): ?string
    {
        return $this->token;
    }

    /**
     * Sets client authorization token
     *
     * @param string $token
     * @return self
     */
    public function setToken(?string $token): self
    {
        $this->token = $token;
        
        return $this;
    }

    /**
     * Tells whether a client has been blocked
     *
     * @return bool|NULL
     */
    public function isBlocked(): ?bool
    {
        return $this->is_blocked === true;
    }

    /**
     * Sets whether a client is blocked
     *
     * @param bool $state
     * @return self
     */
    public function setIsBlocked(?bool $state): self
    {
        $this->is_blocked = true === $state;
        
        return $this;
    }

    /**
     *
     * {@inheritdoc}
     * @see \Cosman\Queue\Client\Model\BaseModel::removeSensitiveAttributes()
     */
    public function removeSensitiveAttributes(array $attributes): array
    {
        unset($attributes['password'], $attributes['token']);
        
        return $attributes;
    }

    /**
     * Checks if a project is owned by a client
     *
     * Checking does not hit repository or database
     *
     * @param Project $project
     * @return bool
     */
    public function ownsProject(?Project $project): bool
    {
        return (null !== $project) && ($project->getClient() instanceof Client) && ($this->getId() === $project->getClient()->getId());
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
        
        $id = (int) $reader->read('id');
        
        if (empty($id)) {
            return null;
        }
        
        $instance = new static();
        $instance->setId($id);
        $instance->setName((string) $reader->read('name'));
        $instance->setEmail((string) $reader->read('email'));
        $instance->setToken((string) $reader->read('token'));
        $instance->setIsBlocked(static::STATUS_BLOCKED === (string) $reader->read('is_blocked'));
        $instance->setCreatedAt($instance->createDatetime((string) $reader->read('created_at')));
        $instance->setUpdatedAt($instance->createDatetime((string) $reader->read('updated_at')));
        
        return $instance;
    }
}