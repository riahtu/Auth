<?php
/**
 * Created by PhpStorm.
 * User: hr00028131
 * Date: 02.04.2019
 * Time: 08:42
 */

namespace Authentication\Application\Service\Client;


class GetPublicKeyRequest
{
    private $rootDir;

    public function __construct(
        $rootDir
    )
    {
        $this->rootDir = $rootDir;
    }

    /**
     * @return mixed
     */
    public function getRootDir()
    {
        return $this->rootDir;
    }
}
