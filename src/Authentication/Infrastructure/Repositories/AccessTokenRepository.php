<?php
/**
 * Created by PhpStorm.
 * User: BlackBit
 * Date: 18-Dec-18
 * Time: 22:32
 */

namespace Authentication\Infrastructure\Repositories;


use Doctrine\ORM\EntityRepository;

class AccessTokenRepository extends EntityRepository
{
    public function findByToken($token)
    {
        return $this->findBy(['token' => $token]);
    }
}
