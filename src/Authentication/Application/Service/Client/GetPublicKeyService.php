<?php
/**
 * Created by PhpStorm.
 * User: hr00028131
 * Date: 02.04.2019
 * Time: 08:41
 */

namespace Authentication\Application\Service\Client;


class GetPublicKeyService
{
    /**
     * @param GetPublicKeyRequest $request
     *
     * @return false|string
     */
    public function execute($request = null)
    {
        return file_get_contents($request->getRootDir() . "/config/jwt/public.pem");
    }
}
