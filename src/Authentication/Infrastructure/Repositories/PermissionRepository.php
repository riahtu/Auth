<?php
/**
 * Created by PhpStorm.
 * User: BlackBit
 * Date: 17-Jan-19
 * Time: 16:09
 */

namespace Authentication\Infrastructure\Repositories;


use Authentication\Domain\Entity\Permission;
use Doctrine\ORM\EntityRepository;

class PermissionRepository extends EntityRepository
{
    public function findByName(string $name)
    {
        return $this->findOneBy(['name' => $name]);
    }

    public function findByRoute(string $route)
    {
        return $this->findOneBy(['route' => $route]);
    }

    public function add(Permission $permission)
    {
        $this->getEntityManager()->persist($permission);
    }
}
