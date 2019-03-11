<?php
/**
 * Created by PhpStorm.
 * User: BlackBit
 * Date: 18-Dec-18
 * Time: 22:31
 */

namespace Authentication\Domain\Entity;


class AccessToken
{
    private $id;
    /**
     * @var User
     */
    private $user;

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
     * @param string $audience
     * @param string|null $token
     * @param bool $active
     *
     * @throws \Exception
     */
    public function __construct(
        string $type,
        string $audience,
        string $token = null,
        bool $active = true
    )
    {
        $this->token = $token ?: bin2hex(random_bytes(60));
        $this->type = $type;
        $this->audience = $audience;
        $this->active = $active;
    }

    /**
     * @param User $user
     *
     * @return AccessToken
     */
    public function setUser(User $user): AccessToken
    {
        $this->user = $user;
        return $this;
    }
    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
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
}
