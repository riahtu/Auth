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
    private $cleanse;

    public function __construct(
        RouteCollection $routes,
        $cleanse
    )
    {
        $this->routes = $routes;
        $this->cleanse = $cleanse;
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
    public function getCleanse()
    {
        return $this->cleanse;
    }
}
