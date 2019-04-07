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
     * NewUserRegistrationRequest constructor.
     * @param string $email
     * @param string $password
     * @param string $username
     */
    public function __construct(
        string $email,
        string $password,
        string $username
    )
    {
        $this->email = $email;
        $this->password = $password;
        $this->username = $username;
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
}
