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
    private $route;
    /**
     * @var string
     */
    private $type;

    public function __construct(
        string $name,
        string $action,
        string $type
    ) {
        $this->roles = new ArrayCollection();
        $this->name  = $name;
        $this->route = $action;
        $this->type  = $type;
    }

    /**
     * @param string $name
     *
     * @return Permission
     */
    public function setName(string $name): Permission
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @param string $route
     *
     * @return Permission
     */
    public function setRoute(string $route): Permission
    {
        $this->route = $route;

        return $this;
    }

    /**
     * @param string $type
     *
     * @return Permission
     */
    public function setType(string $type): Permission
    {
        $this->type = $type;

        return $this;
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
    public function getRoute(): string
    {
        return $this->route;
    }

    public function addRole(Role $role): Permission
    {
        $this->roles[] = $role;

        return $this;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }
}
