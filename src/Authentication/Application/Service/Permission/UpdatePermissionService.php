<?php
/**
 * Created by PhpStorm.
 * User: hr00028131
 * Date: 05.04.2019
 * Time: 14:19
 */

namespace Authentication\Application\Service\Permission;


use Authentication\Domain\Entity\Permission;
use Doctrine\ORM\EntityManagerInterface;

class UpdatePermissionService
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
     * @param UpdatePermissionRequest $request
     *
     * @return array
     */
    public function execute($request = null): array
    {
        $returnMessage = array();
        foreach ($request->getMethods() as $method){
            $permissionRepository = $this->em->getRepository(Permission::class);
            $permission = $permissionRepository->findByName($request->getName());
            /**
             * @var Permission $permission
             */
            if($permission) {
                if($permission->getRoute() !== $request->getRoute()){
                    $permission->setRoute($request->getRoute());
                    $returnMessage[] = 'Route ' . $request->getName() .' -> ' . $method . ' ' . $request->getRoute() . ' has been updated';
                }
            }else{
                $permission = new Permission(
                    $request->getName(),
                    $request->getRoute(),
                    $method
                );
                $permissionRepository->add($permission);

                $returnMessage[] = 'Route ' . $request->getName() .' -> ' . $method . ' ' . $request->getRoute() . ' has been created because it didnt exist';
            }
        }
        return $returnMessage;
    }
}
