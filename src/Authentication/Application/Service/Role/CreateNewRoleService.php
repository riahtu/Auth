<?php
/**
 * Created by PhpStorm.
 * User: BlackBit
 * Date: 13-Jan-19
 * Time: 20:33
 */

namespace Authentication\Application\Service\Role;


use Doctrine\ORM\EntityManagerInterface;
use Authentication\Domain\Entity\Role;
use Authentication\Domain\Services\Exceptions\RoleAlreadyExistsException;
use Transactional\Interfaces\TransactionalServiceInterface;

class CreateNewRoleService implements TransactionalServiceInterface
{
    /**
     * @var \Doctrine\Common\Persistence\ObjectRepository|\Mamoth\Infrastructure\Repositories\RoleRepository
     */
    private $roleRepository;

    /**
     * CreateNewRoleService constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->roleRepository = $entityManager->getRepository(Role::class);
    }

    /**
     * @param CreateNewRoleRequest $request
     * @return array
     * @throws \Doctrine\ORM\ORMException
     */
    public function execute($request = null): array
    {
        $this->checkForTakenNameOrReference($request->getRoleName() , $request->getRoleReference());
        $role = new Role(
            $request->getRoleReference(),
            $request->getRoleName()
        );

        $this->roleRepository->persist($role);

        return array(
            'name' => $role->getName(),
            'reference' => $role->getRole()
        );
    }

    /**
     * @param string $name
     * @param string $reference
     */
    public function checkForTakenNameOrReference(string $name , string $reference): void
    {
        if($this->roleRepository->findByReference($reference)){
            throw new RoleAlreadyExistsException(['reference name' => $reference]);
        }
        if($this->roleRepository->findByName($name)){
            throw new RoleAlreadyExistsException(['name' => $name]);
        }
    }
}
