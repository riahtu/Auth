<?php
/**
 * Created by PhpStorm.
 * User: BlackBit
 * Date: 13-Jan-19
 * Time: 18:09
 */

namespace Authentication\Application\Service\User;


use Doctrine\ORM\EntityManagerInterface;
use Authentication\Domain\Entity\Role;
use Authentication\Domain\Entity\User\User;
use Authentication\Domain\Services\Exceptions\RoleDoesNotExistException;
use Authentication\Domain\Services\Exceptions\UserDoesNotExistException;

class UserApplicationService
{
    /**
     * @var \Doctrine\Common\Persistence\ObjectRepository
     */
    private $userRepository;
    /**
     * @var \Doctrine\Common\Persistence\ObjectRepository
     */
    private $roleRepository;

    public function __construct(
        EntityManagerInterface $entityManager
    )
    {
        $this->userRepository = $entityManager->getRepository(User::class);
        $this->roleRepository = $entityManager->getRepository(Role::class);
    }

    public function findUserOrFail($email): User
    {
        $user = $this->userRepository->findByEmail($email);
        if (!$user) {
            throw new UserDoesNotExistException(['email' => $email]);
        }
        return $user;
    }

    public function findRoleOrFail($roleName): Role
    {
        $role = $this->roleRepository->findRole($roleName);
        if (!$role) {
            throw new RoleDoesNotExistException(['role' => $roleName]);
        }
        return $role;
    }
}
