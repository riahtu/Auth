<?php
/**
 * Created by PhpStorm.
 * User: BlackBit
 * Date: 10-Jan-19
 * Time: 19:39
 */

namespace Authentication\Infrastructure\Repositories;


use Doctrine\ORM\EntityRepository;
use Authentication\Domain\Entity\Role;

class RoleRepository extends EntityRepository
{
    /**
     * @param string $role
     * @return Role|null
     */
    public function findByReference(string $role)
    {
        return $this->findOneBy(['role' => $role]);
    }

    /**
     * @param string $name
     * @return Role|null
     */
    public function findByName(string $name)
    {
        return $this->findOneBy(['name' => $name]);
    }

    /**
     * @param Role $role
     * @throws \Doctrine\ORM\ORMException
     */
    public function persist(Role $role): void
    {
        $this->getEntityManager()->persist($role);
    }

    /**
     * @param Role $role
     * @throws \Doctrine\ORM\ORMException
     */
    public function remove(Role $role): void
    {
        $this->getEntityManager()->remove($role);
    }
}
