<?php
/**
 * Created by PhpStorm.
 * User: BlackBit
 * Date: 31-Mar-19
 * Time: 21:16
 */

namespace Authentication\Application\Service\Permission;

class ImportRouteForPermissionRequest
{

    private $name;
    private $route;
    private $methods;

    /**
     * ImportRouteForPermissionRequest constructor.
     *
     * @param $name
     * @param $route
     * @param $methods
     */
    public function __construct(
        $name,
        $route,
        $methods
    ) {
        $this->name    = $name;
        $this->route   = $route;
        $this->methods = $methods;
    }

    /**
     * @return mixed
     */
    public function getRoute()
    {
        return $this->route;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getMethods()
    {
        return $this->methods;
    }
}
