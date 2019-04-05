<?php
/**
 * Created by PhpStorm.
 * User: hr00028131
 * Date: 05.04.2019
 * Time: 14:20
 */

namespace Authentication\Application\Service\Permission;


class UpdatePermissionRequest
{
    private $name;
    private $route;
    private $methods;

    public function __construct(
        $name,
        $route,
        $methods
    )
    {
        $this->name = $name;
        $this->route = $route;
        $this->methods = $methods;
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
    public function getRoute()
    {
        return $this->route;
    }

    /**
     * @return mixed
     */
    public function getMethods()
    {
        return $this->methods;
    }
}
