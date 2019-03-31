<?php
/**
 * Created by PhpStorm.
 * User: BlackBit
 * Date: 31-Mar-19
 * Time: 10:49
 */

namespace Authentication\Application\Service\Permission;


use Symfony\Component\Routing\RouteCollection;

class ImportRoutesForPermissionRequest
{
    /**
     * @var RouteCollection
     */
    private $routes;
    private $clean;

    public function __construct(
        RouteCollection $routes,
        $clean
    )
    {
        $this->routes = $routes;
        $this->clean = $clean;
    }

    /**
     * @return RouteCollection
     */
    public function getRoutes(): RouteCollection
    {
        return $this->routes;
    }

    /**
     * @return mixed
     */
    public function getClean()
    {
        return $this->clean;
    }
}
