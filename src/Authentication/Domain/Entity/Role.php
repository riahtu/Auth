<?php
/**
 * Created by PhpStorm.
 * User: BlackBit
 * Date: 10-Jan-19
 * Time: 19:39
 */

namespace Authentication\Domain\Entity;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\PersistentCollection;

class Role
{
    const STARTER_ROLE = 'ROLE_USER';
    const ANON_ROLE = 'ROLE_ANON';
    const ADMIN_ROLE = 'ROLE_ADMIN';

    private $id;
    /**
     * @var string
     */
    private $role;
    /**
     * @var PersistentCollection
     */
    private $users;
     /**
     * @var string
     */
    private $name;

    /**
     * Role constructor.
     * @param string $role
     * @param string $name
     */
    public function __construct(
        string $role,
        string $name
    )
    {
        $this->role = $role;
        $this->users = new ArrayCollection();
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getRole(): string
    {
        return $this->role;
    }

    /**
     * @return PersistentCollection
     */
    public function getUsers(): PersistentCollection
    {
        return $this->users;
    }

    /**
     * @param User $user
     * @return Role
     */
    public function addUser(User $user): Role
    {
        $this->users[] = $user;
        return $this;
    }

    /**
     * @param User $user
     * @return Role
     */
    public function removeUser(User $user): Role
    {
        $this->users->removeElement($user);
        return $this;
    }
    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
}
