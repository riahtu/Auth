<?php
/**
 * Created by PhpStorm.
 * User: BlackBit
 * Date: 10-Jan-19
 * Time: 19:39
 */

namespace Authentication\Domain\Entity;


use Authentication\Domain\Entity\Client\Client;
use Authentication\Domain\Entity\User\User;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\PersistentCollection;

class Role
{
    const STARTER_ROLE = 'ROLE_USER';
    const ANON_ROLE = 'ROLE_ANON';
    const ADMIN_ROLE = 'ROLE_ADMIN';
    const ROLE_CLIENT = 'ROLE_CLIENT';

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
     * @var array
     */
    private $permissions;
    /**
     * @var Client[]
     */
    private $clients;

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
        $this->permissions = new ArrayCollection();
        $this->clients = new ArrayCollection();
        $this->name = $name;
    }

    /**
     * @return Client[]
     */
    public function getClients(): array
    {
        return $this->clients;
    }

    /**
     * @param Client $client
     */
    public function addClient(Client $client): void
    {
        $this->clients[] = $client;
    }


    /**
     * @return PersistentCollection
     */
    public function getPermissions(): PersistentCollection
    {
        return $this->permissions;
    }

    public function addPermission(Permission $permission): Role
    {
        $this->permissions[] = $permission;
        return $this;
    }


    public function hasPermission(string $route)
    {
        foreach ($this->getPermissions() as $permission){
            if($permission->getRoute() === $route){
                return $permission;
            }
        }
        return false;
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
