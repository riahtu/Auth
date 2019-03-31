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

    public function __construct(
        $name,
        $route
    )
    {
        $this->name = $name;
        $this->route = $route;
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
}
