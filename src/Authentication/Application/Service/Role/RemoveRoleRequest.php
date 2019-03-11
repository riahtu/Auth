<?php
/**
 * Created by PhpStorm.
 * User: BlackBit
 * Date: 15-Jan-19
 * Time: 18:28
 */

namespace Authentication\Application\Service\Role;


class RemoveRoleRequest
{
    /**
     * @var string
     */
    private $roleReference;

    public function __construct(
        string $roleReference
    )
    {
        $this->roleReference = $roleReference;
    }

    /**
     * @return string
     */
    public function getRoleReference(): string
    {
        return $this->roleReference;
    }
}
