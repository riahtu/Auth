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
    private $projectDir;

    public function __construct($projectDir)
    {
        $this->projectDir = $projectDir;
    }

    /**
     * @param GetPublicKeyRequest $request
     *
     * @return false|string
     */
    public function execute($request = null)
    {
        $file = file_get_contents($this->projectDir . "/config/jwt/public.pem");
        $returnData['key'] = $file;
        $returnData['requestedBy'] = $request->getClient()->getName();
        $returnData['requestedByIp'] = $request->getClient()->getIp();
        return $returnData;
    }
}
