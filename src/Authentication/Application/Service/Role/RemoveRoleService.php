<?php
/**
 * Created by PhpStorm.
 * User: BlackBit
 * Date: 15-Jan-19
 * Time: 18:28
 */

namespace Authentication\Application\Service\Role;


use Doctrine\ORM\EntityManagerInterface;
use Authentication\Domain\Entity\Role;
use Authentication\Domain\Services\Exceptions\RoleDoesNotExistException;
use Transactional\Interfaces\TransactionalServiceInterface;

class RemoveRoleService implements TransactionalServiceInterface
{
    /**
     * @var \Doctrine\Common\Persistence\ObjectRepository|\Mamoth\Infrastructure\Repositories\RoleRepository
     */
    private $roleRepository;
    public function __construct(
        EntityManagerInterface $em
    )
    {
        $this->roleRepository = $em->getRepository(Role::class);
    }

    /**
     * @param RemoveRoleRequest $request
     * @return bool
     * @throws \Doctrine\ORM\ORMException
     */
    public function execute($request = null)
    {
        $role = $this->roleRepository->findByReference($request->getRoleReference());

        if(!$role){
            throw new RoleDoesNotExistException(['role reference' => $request->getRoleReference()]);
        }

        $this->roleRepository->remove($role);
        return true;
    }
}
