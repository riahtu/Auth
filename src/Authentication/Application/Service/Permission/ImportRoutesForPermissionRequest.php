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
    private $update;

    public function __construct(
        RouteCollection $routes,
        $clean,
        $update
    ) {
        $this->routes = $routes;
        $this->clean  = $clean;
        $this->update = $update;
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

    /**
     * @return mixed
     */
    public function getUpdate()
    {
        return $this->update;
    }
}
