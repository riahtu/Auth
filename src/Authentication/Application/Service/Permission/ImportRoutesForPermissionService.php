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

    public function __construct(
        EntityManagerInterface $em,
        ImportRouteForPermissionService $importRouteService
    ) {
        $this->em                 = $em;
        $this->importRouteService = $importRouteService;
        $this->permissionRepository = $this->em->getRepository(Permission::class);
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
            }
        }
        return $returnMessage;
    }

    private function importRoutes(RouteCollection $routes): array
    {
        $returnMessage = array();
        $returnMessage[] = '-------------- Imported Routes --------------';
        foreach ($routes->all() as $name => $route) {
            $returnMessage[] = $this->importRouteService->execute(
                new ImportRouteForPermissionRequest(
                    $name,
                    $route->getPath()
                )
            );
        }
        return $returnMessage;
    }
}
