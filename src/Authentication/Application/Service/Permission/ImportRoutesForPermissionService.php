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
use Symfony\Component\Routing\RouteCollection;
use Transactional\Interfaces\TransactionalServiceInterface;

class ImportRoutesForPermissionService implements TransactionalServiceInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $em;
    /**
     * @var ImportRouteForPermissionService
     */
    private $importRouteService;

    private $permissionRepository;
    /**
     * @var UpdatePermissionService
     */
    private $updateService;

    public function __construct(
        EntityManagerInterface $em,
        ImportRouteForPermissionService $importRouteService,
        UpdatePermissionService $updateService
    ) {
        $this->em                 = $em;
        $this->importRouteService = $importRouteService;
        $this->permissionRepository = $this->em->getRepository(Permission::class);
        $this->updateService = $updateService;
    }

    /**
     * @param ImportRoutesForPermissionRequest $request
     *
     * @return array
     */
    public function execute($request = null): array
    {
        $returnArray = array();

        if($request->getClean()){
            $removedRoutes = $this->removeAllRedundantRoutes($request->getRoutes());
            $returnArray = array_merge($returnArray, $removedRoutes);
        }
        if($request->getUpdate()){
            $updatedRoutes = $this->updateRoutes($request->getRoutes());
            return array_merge($returnArray, $updatedRoutes);
        }
        $importedRoutes = $this->importRoutes($request->getRoutes());

        return array_merge($returnArray, $importedRoutes);
    }

    private function getRouteArray(RouteCollection $routeCollection): array
    {
        $routeArray = array();
        foreach ($routeCollection as $route) {
            $routeArray[] = $route->getPath();
        }
        return $routeArray;
    }

    private function removeAllRedundantRoutes(RouteCollection $routes): array
    {
        $permissions = $this->permissionRepository->findAll();
        $routeArray = $this->getRouteArray($routes);
        $returnMessage = array();
        $returnMessage[] = '-------------- Removed Routes --------------';
        foreach ($permissions as $permission) {
            if ( ! in_array($permission->getRoute(), $routeArray)) {
                $this->permissionRepository->remove($permission);
                $returnMessage[] = $permission->getRoute();
            }else{
                $route = $routes->get($permission->getName());
                if (!in_array($permission->getType() , $route->getMethods())){
                    $returnMessage[] = $permission->getRoute();
                    $this->permissionRepository->remove($permission);
                }
            }
        }
        return $returnMessage;
    }

    private function importRoutes(RouteCollection $routes): array
    {
        $returnMessage = array();
        $returnMessage[] = '-------------- Imported Routes --------------';
        foreach ($routes->all() as $name => $route) {
            $returnMessage = array_merge($returnMessage,
                $this->importRouteService->execute(
                new ImportRouteForPermissionRequest(
                    $name,
                    $route->getPath(),
                    $route->getMethods()
                )
            ));
        }
        return $returnMessage;
    }

    private function updateRoutes(RouteCollection $routes): array
    {
        $returnMessage = array();
        $returnMessage[] = '-------------- Updated Routes --------------';
        foreach ($routes->all() as $name => $route) {
            $returnMessage = array_merge($returnMessage,
                $this->updateService->execute(
                    new UpdatePermissionRequest(
                        $name,
                        $route->getPath(),
                        $route->getMethods()
                    )
                ));
        }
        return $returnMessage;
    }
}
