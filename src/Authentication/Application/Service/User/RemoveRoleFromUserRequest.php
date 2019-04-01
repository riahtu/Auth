<?php
/**
 * Created by PhpStorm.
 * User: BlackBit
 * Date: 13-Jan-19
 * Time: 18:07
 */

namespace Authentication\Application\Service\User;


use Authentication\Domain\Entity\User\User;

class RemoveRoleFromUserRequest
{
    /**
     * @var string
     */
    private $email;
    /**
     * @var string
     */
    private $role;
    /**
     * @var User
     */
    private $user;

    /**
     * AssignRoleToUserRequest constructor.
     * @param string $email
     * @param string $role
     * @param User $user
     */
    public function __construct(
        string $email,
        string $role,
        User $user
    )
    {
        $this->email = $email;
        $this->role = $role;
        $this->user = $user;
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
    public function getRole(): string
    {
        return $this->role;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }
}
