<?php
/**
 * Created by PhpStorm.
 * User: BlackBit
 * Date: 18-Dec-18
 * Time: 22:31
 */

namespace Authentication\Domain\Entity\Client;

class AccessToken
{
    private $id;
    /**
     * @var Client
     */
    private $client;

    private $token;
    /**
     * @var string
     */
    private $type;
    /**
     * @var string
     */
    private $audience;
    /**
     * @var bool
     */
    private $active;

    /**
     * AccessToken constructor.
     *
     *
     * @param string $type
     * @param string|null $token
     * @param bool $active
     *
     * @throws \Exception
     */
    public function __construct(
        string $type,
        string $token = null,
        bool $active = true
    ) {
        $this->token    = $token ?: bin2hex(random_bytes(60));
        $this->type     = $type;
        $this->active   = $active;
    }


    public function setClient(Client $client): AccessToken
    {
        $this->client = $client;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getAudience(): string
    {
        return $this->audience;
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->active;
    }

    /**
     * @param bool $active
     */
    public function setActive(bool $active): void
    {
        $this->active = $active;
    }

    /**
     * @return Client
     */
    public function getClient(): Client
    {
        return $this->client;
    }
}
