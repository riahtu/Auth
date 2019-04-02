<?php
/**
 * Created by PhpStorm.
 * User: BlackBit
 * Date: 31-Mar-19
 * Time: 21:16
 */

namespace Authentication\Application\Service\Permission;


use Authentication\Domain\Entity\Permission;
use Doctrine\ORM\EntityManagerInterface;
use Transactional\Interfaces\TransactionalServiceInterface;

class ImportRouteForPermissionService implements TransactionalServiceInterface
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
     * @param ImportRouteForPermissionRequest $request
     *
     * @return array
     */
    public function execute($request = null): array
    {
        $returnMessage = array();
        foreach ($request->getMethods() as $method){
            $permissionRepository = $this->em->getRepository(Permission::class);
            $permission = $permissionRepository->findByName($request->getName());
            if(!$permission){
                $permission = new Permission(
                    $request->getName(),
                    $request->getRoute(),
                    $method
                );
                $permissionRepository->add($permission);
                $returnMessage[] = 'Route ' . $request->getName() .' -> ' . $method . ' ' . $request->getRoute() . ' has been imported';
            }
            $returnMessage[] = 'Route ' . $request->getName() .' -> ' . $method . ' ' . $request->getRoute() . ' already exists';
        }
        return $returnMessage;
    }
}
