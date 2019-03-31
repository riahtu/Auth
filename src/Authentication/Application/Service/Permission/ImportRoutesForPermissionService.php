<?php
/**
 * Created by PhpStorm.
 * User: BlackBit
 * Date: 31-Mar-19
 * Time: 10:49
 */

namespace Authentication\Application\Service\Permission;


use Authentication\Domain\Entity\Permission;
use Doctrine\ORM\EntityManagerInterface;
use Transactional\Interfaces\TransactionalServiceInterface;

class ImportRoutesForPermissionService implements TransactionalServiceInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @param ImportRoutesForPermissionRequest $request
     *
     * @return string
     */
    public function execute($request = null): string
    {
        $permissionRepository = $this->em->getRepository(Permission::class);
        $permission = $permissionRepository->findByName($request->getName());
        if(!$permission){
            $permission = new Permission(
                $request->getName(),
                $request->getRoute()
            );
            $permissionRepository->add($permission);
            return 'Route ' . $request->getName() .' -> ' . $request->getRoute() . ' has been imported';
        }
        return 'Route ' . $request->getName() .' -> ' . $request->getRoute() . ' already exists';
    }
}
