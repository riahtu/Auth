<?php
/**
 * Created by PhpStorm.
 * User: BlackBit
 * Date: 12-Jan-19
 * Time: 10:08
 */

namespace Authentication\Application\Service\User;


class CreateUserRequest
{
    /**
     * @var string
     */
    private $email;
    /**
     * @var string
     */
    private $password;
    /**
     * @var string
     */
    private $username;
    /**
     * @var bool
     */
    private $signed;
    /**
     * @var string
     */
    private $role;

    /**
     * NewUserRegistrationRequest constructor.
     * @param string $email
     * @param string $password
     * @param string $username
     * @param bool $signed
     * @param string|null $role
     */
    public function __construct(
        string $email,
        string $password,
        string $username,
        bool $signed = false,
        string $role = null
    )
    {
        $this->email = $email;
        $this->password = $password;
        $this->username = $username;
        $this->signed = $signed;
        $this->role = $role;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @return bool
     */
    public function isSigned(): bool
    {
        return $this->signed;
    }

    /**
     * @return null
     */
    public function getRole()
    {
        return $this->role;
    }
}
