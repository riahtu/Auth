<?php
/**
 * Created by PhpStorm.
 * User: BlackBit
 * Date: 31-Mar-19
 * Time: 10:49
 */

namespace Authentication\Application\Service\Permission;


class ImportRoutesForPermissionRequest
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
