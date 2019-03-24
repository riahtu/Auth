<?php
/**
 * Created by PhpStorm.
 * User: BlackBit
 * Date: 17-Jan-19
 * Time: 16:07
 */

namespace Authentication\Domain\Entity;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\PersistentCollection;

class Permission
{
    private $id;
    /**
     * @var PersistentCollection
     */
    private $roles;
    /**
     * @var string
     */
    private $name;
    /**
     * @var string
     */
    private $action;

    public function __construct(
        string $name,
        string $action
    )
    {
        $this->roles = new ArrayCollection();
        $this->name = $name;
        $this->action = $action;
    }

    /**
     * @return PersistentCollection
     */
    public function getRoles(): PersistentCollection
    {
        return $this->roles;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getAction(): string
    {
        return $this->action;
    }

    public function addRole(Role $role): Permission
    {
        $this->roles[] = $role;
        return $this;
    }
}
