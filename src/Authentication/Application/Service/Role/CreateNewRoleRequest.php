<?php
/**
 * Created by PhpStorm.
 * User: BlackBit
 * Date: 13-Jan-19
 * Time: 20:33
 */

namespace Authentication\Application\Service\Role;


class CreateNewRoleRequest
{
    /**
     * @var string
     */
    private $roleName;
    /**
     * @var string
     */
    private $roleReference;


    public function __construct(
        string $roleName,
        string $roleReference
    )
    {
        $this->roleName = $roleName;
        $this->roleReference = $roleReference;
    }

    /**
     * @return string
     */
    public function getRoleReference(): string
    {
        return $this->roleReference;
    }

    /**
     * @return string
     */
    public function getRoleName(): string
    {
        return $this->roleName;
    }
}
