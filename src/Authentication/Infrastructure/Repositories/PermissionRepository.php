<?php
/**
 * Created by PhpStorm.
 * User: BlackBit
 * Date: 17-Jan-19
 * Time: 16:09
 */

namespace Authentication\Infrastructure\Repositories;


use Doctrine\ORM\EntityRepository;

class PermissionRepository extends EntityRepository
{
    public function findByName(string $name)
    {
        return $this->findOneBy(['name' => $name]);
    }
}
