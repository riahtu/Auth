<?php
/**
 * Created by PhpStorm.
 * User: BlackBit
 * Date: 18-Dec-18
 * Time: 20:29
 */

namespace Authentication\Infrastructure\Repositories;


use Doctrine\ORM\EntityRepository;
use Authentication\Domain\Entity\User;

class UserRepository extends EntityRepository
{
    /**
     * @param User $user
     *
     * @throws \Doctrine\ORM\ORMException
     */
    public function persist(User $user): void
    {
        $this->getEntityManager()->persist($user);
    }

    /**
     * @param $email
     * @return User|null
     */
    public function findByEmail($email)
    {
        return $this->findOneBy(['email' => $email]);
    }

    /**
     * @param $username
     * @return User|null
     */
    public function findByUsername($username)
    {
        return $this->findOneBy(['username' => $username]);
    }
}
